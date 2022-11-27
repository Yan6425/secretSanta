from json import load, dump
from random import randint


def envoyerMail(secretSanta, participant):
    print(f"Bravo {secretSanta}, tu es le secret Santa de {participant}.")


def tirageAuSort():
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)

    peutCommencer = True
    for confirmation in dicoParticipants.values():
        if confirmation is None:
            peutCommencer = False

    if peutCommencer:
        listeParticipants = list(dicoParticipants)
        for participant in dicoParticipants:
            envoyerMail(participant, listeParticipants.pop(randint(0, len(listeParticipants) - 1)))


def validation(participant, réponse):
    with open('participants.json') as fichierJson:
        dicoParticipants = load(fichierJson)
    
    if dicoParticipants[participant] is not None:
        return "déjàValidé"
    else:
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