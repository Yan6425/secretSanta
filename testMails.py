import smtplib, ssl
from email.message import EmailMessage

msg = EmailMessage()
msg.set_content("Le corps de l'e-mail est ici")
msg["Subject"] = "Email de Test"
msg["From"] = "secretsanta@orange.fr"
msg["To"] = "deuxiemecomptedeyan@gmail.com"
context=ssl.create_default_context()

with smtplib.SMTP("smtp.orange.fr", port=587) as smtp:
    smtp.starttls(context=context)
    smtp.login("yan.youtube@orange.fr", "Bearnais64!")
    smtp.send_message(msg)