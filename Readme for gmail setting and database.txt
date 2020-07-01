gmail setting for sending mail
- using gmail(goggle mail)
- go to https://mail.google.com/
- login gmail
- at top right setting gmail click
- click manage your account
- in left click security
- seacrh "Access less secure applications"
- active acces for "Access less secure applications"

database :
table "user" :
	- id_user (key)
	- name
	- email
	- password
	- image
	- level (using integer 0 for admin, 1 for user)
	- active_email (int(1))
table "user_token" :
	- id_token (key)
	- email
	- token
	- create_token