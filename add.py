#!/usr/bin/env python
# -*- coding: utf-8 -*-
#

def main():
	import mysql.connector 
	
	lat = float(input())
	longi = float(input())
	
	conn = mysql.connector.connect(host="localhost",user="root",password="root", database="maxime1_favier")
	cursor = conn.cursor()
	enter = (1, lat, longi)
	# INSERT INTO `maxime1_favier`.`positions` (`id`, `idmoutton`, `datation`, `lat`, `lng`) VALUES (NULL, '1', NOW(), '1.25453', '57.574');
	
	cursor.execute("""INSERT INTO `positions` (`idmoutton`, `datation`, `lat`, `lng`) VALUES(%s ,NOW(),%s, %s)""", enter)
	#cursor.fetchall()
	cursor.execute("""SELECT * FROM `positions`""")
	rows = cursor.fetchall()
	print(rows)
	conn.close()
	
	return 0

if __name__ == '__main__':
	main()
