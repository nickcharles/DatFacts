from flask import Flask, render_template
import controllers
import thread
from controllers.twilio_wrapper import run_twilio_api

app = Flask(__name__, template_folder='views')

app.register_blueprint(controllers.main)



# comment this out using a WSGI like gunicorn
# if you dont, gunicorn will ignore it anyway
if __name__ == '__main__':
    # listen on external IPs
    thread.start_new_thread(run_twilio_api, ())
    app.run(host='0.0.0.0', port=3000, debug=True)