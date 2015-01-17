import requests
import json

def getNumbers():
    print "TEST"
    response = requests.get('https://luminous-fire-1975.firebaseio.com/phoneNumbers.json')
    print "test"
    numbers = json.loads(response.text)
    return numbers

def addNumber(number, subject):
    if verifyNumber(number) and verifySubject(subject):
        newVictim = {"count": 1, "subject": subject}
        result = requests.put('https://luminous-fire-1975.firebaseio.com/phoneNumbers/' + number + '.json', data=json.dumps(newVictim))
        return True
    return False

def deleteNumber(number):
    if verifyNumber(number):
        request = requests.delete('https://luminous-fire-1975.firebaseio.com/phoneNumbers/' + number + '.json')


def verifySubject(subject):
    return True

def verifyNumber(number):
    return True