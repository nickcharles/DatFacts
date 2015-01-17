from flask import *
from firebase import firebase
import re
import string

main = Blueprint('main', __name__, template_folder='views')

@main.route('/')
def main_route():
	if request.method == 'POST':
		# phoneNum = checkPhoneNum(request.form['phoneNum'])
		# subject = checkSubject(request.form['subject'])
		addSubscriber(phoneNum, subject)
		return render_template("index.html", phoneNum=phoneNum, subject=subject)
	return render_template("index.html");

@main.route('/unsubscribe')
def unsubscribe():
	if request.method == 'POST':
		phoneNum = request.form['yourNum']
		newNum = request.form['newNum']
		subject = request.form['subject']
		removeSubcriber(phoneNum)
		addSubscriber(newNum, subject)
	return render_template("unsub.html")


def addSubscriber(number, subject):
	return True

def removeSubscriber(number):
	return True

def checkPhoneNum(number):
	isPhoneNum = re.compile("^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$");
	if not isPhoneNum.match(number):
		return None
	re.sub("[^0-9]", "", number)
	return number

def checkSubject(subject):
	if subject is None or subject == string.empty:
		return 'cat'

	return subject

# @main.route('/replies')
# def replies():
# 	firebase = firebase.FirebaseApplication('https://luminous-fire-1975.firebaseio.com')
# 	result = firebase.get('replies', None)
# 	return render_template("replies.html")