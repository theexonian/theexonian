#!/usr/bin/python2.7

import cgi
from MySQLdb import connect
from datetime import now

if True:
    import os
    f = open('ips.txt', 'w')
    f.write(os.environ["REMOTE_ADDR"])
    f.write(" " + str(now()))
    f.close()

form = cgi.FieldStorage()

print "Content-Type: text"
print ""

conn = connect(host="localhost", user="theexoni_pay", passwd="7435ty31415", db="theexoni_payments")
c = conn.cursor()
c.execute('UPDATE subscriptions SET SUBSCRIPTION_END = DATE_ADD(SUBSCRIPTION_END, INTERVAL 1 YEAR) WHERE CUSTOMER_ID=%s;', (form["EXT_TRANS_ID"].value))
conn.commit()
c.close()
