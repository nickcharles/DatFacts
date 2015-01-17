from flask import *
from wikipedia_wrapper import *
from firebase_wrapper import addNumber, deleteNumber
import re
import string

main = Blueprint('main', __name__, template_folder='views')

@main.route('/', methods=['GET', 'POST'])
def main_route():
    if request.method == 'POST':
        number = request.form['number']
        subject = request.form['subject']
        handle(number, subject)
        return redirect('/')
    return render_template("index.html")

@main.route('/unsubscribe', methods=['GET', 'POST'])
def unsubscribe():
    if request.method == 'POST':
        phoneNum = request.form['yourNum']
        newNum = request.form['newNum']
        subject = request.form['subject']
        removeSubcriber(phoneNum)
        addSubscriber(newNum, subject)
    return render_template("unsub.html")


def handle(number, subject):
    # Validate input
    (number, subject) = validateInput(number, subject)
    # Wikipedia lookup
    print getFact(subject);
    # Add to database
    # addNumber(number, subject)
    # addNumber(number, subject)
    # Begin texting
    return render_template("index.html")

def validateInput(number, subject):
    number = validateNumber(number)
    subject = validateSubject(subject)
    return (number, subject)

def validateNumber(number):
    isPhoneNum = re.compile("^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$")
    if not isPhoneNum.match(number):
        return render_template("index.html")
    number = re.sub("[^0-9]", "", number)
    return number

def validateSubject(subject):
    if subject is None or subject == "":
        return 'cat'
    return subject

def addSubscriber(number, subject):
    return True

def removeSubscriber(number):
    return True

# @main.route('/replies')
# def replies():
#   firebase = firebase.FirebaseApplication('https://luminous-fire-1975.firebaseio.com')
#   result = firebase.get('replies', None)
#   return render_template("replies.html")