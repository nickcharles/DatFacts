from flask import *
from firebase import firebase

main = Blueprint('main', __name__, template_folder='views')

@main.route('/')
def main_route():
	if request.method == 'POST':
		phoneNum = checkPhoneNum(request.form['phoneNum'])
		subject = checkSubject(subjecrequest.form['subject'])
		addSubscriber(phoneNum, subject)

	return render_template("index.html")

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