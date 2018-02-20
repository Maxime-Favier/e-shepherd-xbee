#!/usr/bin/env python
# coding: utf-8

# chargement des libs
import serial, re, requests
from digi.xbee.devices import XBeeDevice

# connection en serial au Xbee
device = XBeeDevice("/dev/ttyAMA0", 9600)
device.open()
print("connecté")


while True:
	try:
		# ---- RECUPERATION ET TRAITEMENT DE LA TRAME ---- #
		xbee_message = device.read_data()	# récuperation de la trame
		if(xbee_message != None):
			msg = str(xbee_message.data)	# convertion en str
			msg = re.findall(r'\[(.*?)\]',msg)	# suppression des donnnés non voulue
			msg = msg[0]	# reconversion en str
			msg = msg.replace(" ", "")	# suppresion des espaces
			msg = msg.split(",")	# conversion en liste
			print(msg)
			
			# ---- ENVOI DE LA REQUETE AU SERVEUR ---- #
			sendcontent = {'idmoutton': msg[2],'lat': msg[0], 'lng': msg[1],'mdp': '2788223e73728d8339cbc5366945c90b0a394bfa6bafe1426cc5eb221fd36bba'}
			r = requests.post("http://localhost/lisnter.php", data=sendcontent)
			print("done")

	except KeyboardInterrupt:
		break
		
# déconnection
device.close()


