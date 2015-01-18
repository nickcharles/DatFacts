from twilio.rest import TwilioRestClient
from wikipedia_wrapper import getFact
from firebase_wrapper import getNumbers, updateCount, deleteNumber
import time
import random

accountSID = "ACcbaaff60ee6acbc930d6912fbaa2456a"
authToken = "8b4a4f3b93a61ed471f05aed4c9b962f"

twilioNumber = "734-393-4311"

def run_twilio_api():
    client = TwilioRestClient(accountSID, authToken)
    while True:
        numbers = getNumbers()
        for number in numbers.keys():
            victim = numbers[number]
            count = victim["count"]
            subject = victim["subject"]
            if count > 3:
                deleteNumber(number)
            elif number != '5178969810':
                print number
                fact = getFact(subject)
                print fact
                message = client.messages.create(to=number, from_=twilioNumber, body=fact)
                updateCount(number, count)

        sleepTime = random.randint(20, 240)
        time.sleep(sleepTime)

def main():
    run_twilio_api()

if __name__ == "__main__":
    main()
