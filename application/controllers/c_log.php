<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_log extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('log/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            if ($user['active_email'] == 0) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    redirect('C_home');
                } else {
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-danger" role="alert">
                        This email has not been activated!
                    </div>
                    ');
                    redirect('c_log');
                }
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-warning" role="alert">
                    This email has not been activated!
                </div>
                ');
                redirect('c_log');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role="alert">
	            This email not registered!
            </div>
            ');
            redirect('c_log');
        }
    }

    public function regis()
    {
        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email already registered!'
        ]);
        $this->form_validation->set_rules('passwordsignin', 'passwordsignin', 'required|trim|min_length[8]|matches[confirmpassword]', [
            'matches' => 'Password didnt match!',
            'min_length' => 'Password required 8 character!'
        ]);
        $this->form_validation->set_rules('confirmpassword', 'confirmpassword', 'required|trim|min_length[8]|matches[passwordsignin]');
        if ($this->form_validation->run() == false) {
            $this->load->view('log/regis');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'dafault.jpg',
                'password' => password_hash($this->input->post('passwordsignin'), PASSWORD_DEFAULT),
                'level' => 1, #0 untuk admin, 1 untuk user
                'active_email' => 0 #0 belum aktif, 1 aktif untuk email 
            ];

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => htmlspecialchars($this->input->post('email', true)),
                'token' => $token,
                'create_token' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_emailActive($token, 'verify');

            $this->session->set_flashdata('message', '
            <div class="alert alert-success" role="alert">
	            Validation has been sent to your email! please activate before 24 hours!
            </div>
            ');
            redirect('c_log');
        }
    }

    private function _emailActive($token, $type)
    {
        $usernameGoogle = '@gmail.com'; //username google or gmail
        $passwordGoogle = ''; // password google or gmail
        $config = [
            'protocol' => 'smtp',
            'smtp_crypto' => 'ssl',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => $usernameGoogle, 
            'smtp_pass' => $passwordGoogle, 
            'smtp_port' => 465, #smtp google
            'smtp_timeout' => '30',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from($usernameGoogle, 'Title'); //tiitle diisi dengan judul
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verrification');
            $this->email->message('Click this link to verify your account! : <a href="' . base_url() . 'c_log/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password! : <a href="' . base_url() . 'c_log/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['create_token'] < (60 * 60 * 24)) {
                    $this->db->set('active_email', 0);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '
                    <div class="alert alert-success" role="alert">
                        ' . $email . ' has been activated! You can log in now!
                    </div>
                    ');
                    redirect('c_log');
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '
                    <div class="alert alert-warning" role="alert">
                        Account activation expired!
                    </div>
                    ');
                    redirect('c_log');
                }
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-danger" role="alert">
                    Account activation fail!
                </div>
                ');
                redirect('c_log');
            }
        } else {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger" role="alert">
	            Account activation fail!
            </div>
            ');
            redirect('c_log');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
        if ($this->form_validation->run() == false) {
            $this->load->view('log/forgot');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();

            if ($user) {
                if ($user['active_email'] == 0) {
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                        'email' => $email,
                        'token' => $token,
                        'create_token' => time()
                    ];

                    $this->db->insert('user_token', $user_token);
                    $this->_emailActive($token, 'forgot');

                    $this->session->set_flashdata('message', '
                    <div class="alert alert-success" role="alert">
                        Check your email to reset password!
                    </div>
                    ');
                    redirect('c_log');
                } else {
                    $this->session->set_flashdata('message', '
                    <div class="alert alert-warning" role="alert">
                        Your email already registered but didnt verified! Please check your email! 
                    </div>
                    ');
                    redirect('c_log');
                }
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-warning" role="alert">
                    Email not registered!
                </div>
                ');
                redirect('c_log/forgotPassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['create_token'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '
                    <div class="alert alert-warning" role="alert">
                        Reset password expired!
                    </div>
                    ');
                    redirect('c_log');
                }
            } else {
                $this->session->set_flashdata('message', '
                <div class="alert alert-warning" role="alert">
                    Error reset password!
                </div>
                ');
                redirect('c_log');
            }
        } else {
            $this->session->set_flashdata('message', '
                <div class="alert alert-warning" role="alert">
                    Email no registered!
                </div>
                ');
            redirect('c_log');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('c_log');
        }
        $this->form_validation->set_rules('passwordreset', 'passwordreset', 'required|trim|min_length[8]|matches[confirmpassword]', [
            'matches' => 'Password didnt match!',
            'min_length' => 'Password required 8 character!'
        ]);
        $this->form_validation->set_rules('confirmpassword', 'confirmpassword', 'required|trim|min_length[8]|matches[passwordreset]');


        if ($this->form_validation->run() == false) {
            $this->load->view('log/reset');
        } else {
            $password = password_hash($this->input->post('passwordreset'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">
                    Password has been update! You can login with new password!
                </div>
                ');
            redirect('c_log');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('name');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('level');

        redirect('c_log');
    }
}
