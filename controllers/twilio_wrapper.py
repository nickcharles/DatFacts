from twilio.rest import TwilioRestClient
from wikipedia_wrapper import getFact
from firebase import firebase
import time
import random

accountSID = "ACcbaaff60ee6acbc930d6912fbaa2456a"
authToken = "8b4a4f3b93a61ed471f05aed4c9b962f"

twilioNumber = "734-393-4311"


def run_twilio_api():
	fb = firebase.FirebaseApplication('https://luminous-fire-1975.firebaseio.com', None)
	client = TwilioRestClient(accountSID, authToken)
	while True:
		print "TEST"
		numbers = fb.get('/phoneNumbers', None)

		print "test"
		print numbers
		for number in numbers.keys():
			print number
			victim = numbers[number]
			count = victim["count"]
			subject = victim["subject"]
			fact = getFact(subject)
			# message = client.messages.create(to=number, from_=twilioNumber, body=fact)

			sleepTime = random.randint(20, 240)
			time.sleep(sleepTime)


def verifyNumber(number):
	return True