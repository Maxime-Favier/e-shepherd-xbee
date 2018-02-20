#!/usr/bin/env python3
# coding: utf-8

import serial, time, random
from digi.xbee.devices import XBeeDevice

device = XBeeDevice("/dev/ttyAMA0", 9600)
device.open()
print("connecté")


while True:
	try:
		loln = str([random.random(),random.random(),random.random()])
		device.send_data_broadcast(loln)
		time.sleep(5)
		print("woirk")
	except KeyboardInterrupt:
		
		break
device.close()
