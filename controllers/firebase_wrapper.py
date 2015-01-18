import requests
import json
from twilio.rest import TwilioRestClient

accountSID = "ACcbaaff60ee6acbc930d6912fbaa2456a"
authToken = "8b4a4f3b93a61ed471f05aed4c9b962f"
twilioNumber = "734-393-4311"
client = client = TwilioRestClient(accountSID, authToken)

def getNumbers():
    # print "TEST"
    response = requests.get('https://luminous-fire-1975.firebaseio.com/phoneNumbers.json')
    # print "test"
    numbers = json.loads(response.text)
    return numbers

def addNumber(number, subject):
    print number
    client.messages.create(to=number, _from=twilioNumber, body="Thank you for subscribing to " + subject + " facts. For more information visit datfacts.me")
    if verifyNumber(number) and verifySubject(subject):
        newVictim = {"count": 0, "subject": subject}
        result = requests.put('https://luminous-fire-1975.firebaseio.com/phoneNumbers/' + number + '.json', data=json.dumps(newVictim))
        return True
    return False

def deleteNumber(number):
    if verifyNumber(number):
        request = requests.delete('https://luminous-fire-1975.firebaseio.com/phoneNumbers/' + number + '.json')

def updateCount(number, count):
    count = count + 1
    updatedCount = {"count": count}
    if verifyNumber(number):
        request = requests.patch('https://luminous-fire-1975.firebaseio.com/phoneNumbers/' + number + '.json', data=json.dumps(updatedCount))


def verifySubject(subject):
    return True

def verifyNumber(number):
    return True