#!/usr/bin/python2.7

#import cgitb; cgitb.enable()

import cgi
from MySQLdb import connect
from datetime import date
from uuid import uuid4

fields = ["BILL_CITY", "BILL_COUNTRY", "BILL_NAME", "BILL_POSTAL_CODE", "BILL_STREET1", "BILL_STREET2", "EMAIL_ADDRESS",
          "FIRST_NAME", "LAST_NAME", "PHONE", "SHIP_CITY", "SHIP_COUNTRY", "SHIP_NAME", "SHIP_POSTAL_CODE",
          "SHIP_STREET1", "SHIP_STREET2", "TITLE", "sameBilling"]

reqFields = ["EMAIL_ADDRESS", "FIRST_NAME", "LAST_NAME", "SHIP_CITY", "SHIP_COUNTRY", "SHIP_NAME", "SHIP_POSTAL_CODE",
             "SHIP_STREET1", "TITLE", "sameBilling"]

UPAY_SITE_ID = "6"
CUSTOMER_ID = str(uuid4())
VALIDATION_KEY = "28b6773d-33f9-4b80-b88a-c90ecb9c458a"
url = "https://secure.touchnet.com:8443/C25385test_upay/web/index.jsp"

form = cgi.FieldStorage(keep_blank_values=True)

allFields = True
try:
    if form["TITLE"].value == "-":
        reqFields.append("TITLE_OTHER")
    if form["SHIP_COUNTRY"].value == "US" or form["SHIP_COUNTRY"].value == "CA":
        reqFields.append("SHIP_STATE_" + form["SHIP_COUNTRY"].value)
    else:
        reqFields.append("SHIP_STATE_--")
    if form["sameBilling"].value == "off":
        if form["BILL_COUNTRY"].value == "US" or form["BILL_COUNTRY"].value == "CA":
            reqFields.append("BILL_STATE_" + form["BILL_COUNTRY"].value)
        else:
            reqFields.append("BILL_STATE_--")
        reqFields += ["BILL_CITY", "BILL_COUNTRY", "BILL_NAME", "BILL_POSTAL_CODE", "BILL_STREET1"]
except KeyError:
    allFields = False

print "Content-Type: text/html"
print
print """<!DOCTYPE html>

    <html>
        <head>
            <title>Processing...</title>
        </head>
        <body>"""

data = {}

if allFields:
    for k in reqFields:
        if not k in form:
            allFields = False
            break
        if form[k].value == "":
            allFields = False
            break

for k in form:
    value = form[k].value
    if k not in fields:
        continue
    elif k == "TITLE":
        if value == "-":
            data[k] = form["TITLE_OTHER"].value
            continue
    elif "COUNTRY" in k:
        if value == "US" or value == "CA":
            data[k[:5] + "STATE"] = form[k[:5] + "STATE_" + value].value
        else:
            data[k[:5] + "STATE"] = form[k[:5] + "STATE_--"].value
    data[k] = value

wait = 0
if allFields:
    if data["sameBilling"] == "on":
        for k in data:
            if "SHIP" in k:
                value = data[k]
                data["BILL" + k[4:]] = value
    postData = {}
    for k in data:
        if "BILL" in k:
            postData[k] = data[k]

    postData["UPAY_SITE_ID"] = UPAY_SITE_ID
    postData["EXT_TRANS_ID"] = CUSTOMER_ID
    postData["VALIDATION_KEY"] = VALIDATION_KEY
    postData["BILL_EMAIL_ADDRESS"] = data["EMAIL_ADDRESS"]

    conn = connect(host="localhost", user="theexoni_pay", passwd="7435ty31415", db="theexoni_payments")
    c = conn.cursor()
    c.execute('''CREATE TABLE IF NOT EXISTS subscriptions (
            CUSTOMER_ID VARCHAR(255),
            FIRST_NAME VARCHAR(255),
            LAST_NAME VARCHAR(255),
            TITLE VARCHAR(255),
            EMAIL_ADDRESS VARCHAR(255),
            PHONE VARCHAR(255),
            SHIP_COUNTRY VARCHAR(255),
            SHIP_NAME VARCHAR(255),
            SHIP_STREET1 VARCHAR(255),
            SHIP_STREET2 VARCHAR(255),
            SHIP_CITY VARCHAR(255),
            SHIP_STATE VARCHAR(255),
            SHIP_POSTAL_CODE VARCHAR(255),
            BILL_COUNTRY VARCHAR(255),
            BILL_NAME VARCHAR(255),
            BILL_STREET1 VARCHAR(255),
            BILL_STREET2 VARCHAR(255),
            BILL_CITY VARCHAR(255),
            BILL_STATE VARCHAR(255),
            BILL_POSTAL_CODE VARCHAR(255),
            SUBSCRIPTION_END DATE);''')
    c.execute('INSERT INTO subscriptions VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s);',
              (CUSTOMER_ID, data["FIRST_NAME"], data["LAST_NAME"], data["TITLE"], data["EMAIL_ADDRESS"], data["PHONE"],
               data["SHIP_COUNTRY"], data["SHIP_NAME"], data["SHIP_STREET1"], data["SHIP_STREET2"], data["SHIP_CITY"],
               data["SHIP_STATE"], data["SHIP_POSTAL_CODE"], data["BILL_COUNTRY"], data["BILL_NAME"],
               data["BILL_STREET1"], data["BILL_STREET2"], data["BILL_CITY"], data["BILL_STATE"],
               data["BILL_POSTAL_CODE"], date.today().isoformat())) #sanatizing
    conn.commit()
    c.close()

    print """
        </body>
        </html>"""
    print "<form name=\"PostForm\" action=\"%s\" method=\"post\">" % url
    for k in postData:
        print "<input type=\"hidden\" name=\"%(k)s\" value=\"%(v)s\">" % {"k":k, "v":postData[k]}
    print "</form><script language='javascript'>document.PostForm.submit();</script>"
else:
    print """You do not seem to have enough forms filled in. You will be redirected to back to the subscriptions page in three seconds.
            </body>
        </html>
        <script language='javascript'>setTimeout(function() {window.location.href = "http://www.theexonian.com/subscribe"}, 3000);</script>"""
