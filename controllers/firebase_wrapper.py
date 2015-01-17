from firebase import firebase
from twilio_wrapper import verifyNumber

fb = firebase.FirebaseApplication('https://luminous-fire-1975.firebaseio.com', None)

def getNumbers():
	result = fb.get('/phoneNumbers', None)
	return result

def addNumber(number, subject):
	if verifyNumber(number) and verifySubject(subject):
		newVictim = {'count': 1, 'subject': subject}
		result = fb.post('/phoneNumbers/' + str(number), newVictim)
		print result
		return True

#2488427486
def verifySubject(subject):
	return True