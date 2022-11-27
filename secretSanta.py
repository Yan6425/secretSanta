from json import load, dump
from flask import template


def tirageAuSort():
    with open('participants.json') as fichierJson:
        listeParticipants = load(fichierJson)

    peutCommencer = True
    for confirmation in listeParticipants.values():
        if confirmation is None:
            peutCommencer = False

    if peutCommencer:
        for participants in listeParticipants:
            pass


def validation(participant, réponse):
    with open('participants.json') as fichierJson:
        listeParticipants = load(fichierJson)
    
    if listeParticipants[participant] is not None:
        return "déjàValidé"
    else:
        listeParticipants[participant] = réponse

    with open('participants.json', 'w') as fichierJson:
        dump(listeParticipants, fichierJson)

    tirageAuSort()


def resetListeParticipants(participant = None):
    with open('participants.json') as fichierJson:
        listeParticipants = load(fichierJson)
    
    if participant is not None:
        listeParticipants[participant] = None
    else:
        for participant in listeParticipants:
            listeParticipants[participant] = None

    with open('participants.json', 'w') as fichierJson:
        dump(listeParticipants, fichierJson)