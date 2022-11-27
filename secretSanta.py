from json import load, dump
from random import randint
from flask import render_template
import smtplib, ssl
from email.message import EmailMessage


def envoyerMail(secretSanta, participant):
    msg = EmailMessage()
    msg.set_content(render_template('mail.html', utilisateur = secretSanta, participant = participant))
    msg["Subject"] = "Ta participation au secret Santa !"
    msg["From"] = "secretsanta@orange.fr"
    msg["To"] = "deuxiemecomptedeyan@gmail.com"
    context=ssl.create_default_context()

    with smtplib.SMTP("smtp.orange.fr", port=587) as smtp:
        smtp.starttls(context=context)
        smtp.login("yan.youtube@orange.fr", "Bearnais64!")
        smtp.send_message(msg)


def obtenirEmail(participant):
    if participant == 'inconnu':
        return
    with open('emails.json') as fichierJson:
        dicoEmails = load(fichierJson)
    return dicoEmails[participant]


def tirageFini():
    return peutCommencer()


def peutCommencer():
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)

    res = True
    for confirmation in dicoParticipants.values():
        if confirmation is None:
            res = False
    return res


def tirageAuSort():
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)

    if peutCommencer():
        listeParticipants = list(dicoParticipants)
        for participant in dicoParticipants:
            participant2 = listeParticipants.pop(randint(0, len(listeParticipants) - 1))
            envoyerMail(participant, participant2)


def déjàValidé(participant):
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)

    return dicoParticipants[participant] is not None


def validation(participant, réponse):
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)
    
    dicoParticipants[participant] = réponse

    with open('participants.json', 'w') as fichierJson:
        dump(dicoParticipants, fichierJson)

    tirageAuSort()


def resetDicoParticipants(participant = None):
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)
    
    if participant is not None:
        dicoParticipants[participant] = None
    else:
        for participant in dicoParticipants:
            dicoParticipants[participant] = None

    with open('participants.json', 'w') as fichierJson:
        dump(dicoParticipants, fichierJson)


def enregistrerEmail(utilisateur, email):
    if len(email) < 10:
        return False
    elif not "@" in email[1:]:
        return False
    elif email[-4::] != ".com" and email[-3::] != ".fr":
        return False
    else:
        with open('emails.json') as fichierJson:
            dicoEmails = load(fichierJson)
            dicoEmails[utilisateur] = email
        with open('emails.json', 'w') as fichierJson:
            dump(dicoEmails, fichierJson)
        return True