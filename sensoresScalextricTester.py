#!/usr/bin/env python
#! encoding: utf8

import RPi.GPIO as GPIO #importamos la libreria y cambiamos su nombre por "GPIO"
import time #necesario para los delays ((tsecs % 3600)%60)
class Sensor():
	pin=0
	boolUpDown=True
	boolActivate=True
	firstTime=0.0
	secondTime=0.0
	time=0.0
	space=0.02
	speed=0.0
	def __init__(self, p):
		self.pin=p

	def setPin(self, t):
                self.pin=t
        def getPin(self):
                return self.pin
        def setBoolUpDown(self, t):
                self.boolUpDown=t
        def isBoolUpDown(self):
                return self.boolUpDown
        def setBoolActivate(self, t):
                self.boolActivate=t
        def isBoolActivate(self):
                return self.boolActivate
	def setFirstTime(self, t):
		self.firstTime=t
	def getFirstTime(self):
                return self.firstTime
	def setSecondTime(self, t):
                self.secondTime=t
	def getSecondTime(self):
                return self.secondTime
	def setTime(self, t):
                self.time=t
	def getTime(self):
                return self.time
        def setSpace(self, t):
                self.space=t
        def getSpace(self):
                return self.space
        def setSpeed(self, t):
                self.speed=t
        def getSpeed(self):
                return self.speed

	def calculate_Time(self):
		self.time=self.secondTime - self.firstTime
	def calculate_Speed(self):
		self.speed=self.space*3600/(self.time*1000)

sensor_1 = Sensor(21)
def loop():
    raw_input()
def tiempoInicial(self): 
        global sensor_1
	sensor_1.setFirstTime(time.time())
	sensor_1.setBoolUpDown(False)
	sensor_1.setBoolActivate(True)
	print "calculando..."		
def tiempoFinal(self):
	global sensor_1
        sensor_1.setSecondTime(time.time())
        sensor_1.calculate_Time()
        sensor_1.calculate_Speed()
	print u"\nSensor1: \n\tpin: %d " %(sensor_1.getPin())
        print u"\n\ttoma de tiempo 1: %f "%(sensor_1.getFirstTime())
        print u"\n\ttoma de tiempo 2: %f "%(sensor_1.getSecondTime())
        print u"\n\ttiempo: %f "%( sensor_1.getTime())
        print u"\n\tdistancia: %f "%(sensor_1.getSpace())
        print u"\n\tvelocidad: %f" %(sensor_1.getSpeed())

	sensor_1.setBoolUpDown(True)
	sensor_1.setBoolActivate(True)
			 

#establecemos el sistema de numeracion, en mi caso BCM
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
#configuramos el pin GPIO17 como una salida
GPIO.setup(sensor_1.pin, GPIO.IN)
# Creamos las clases sensor necesarias  GPIO.cleanup()  #devuelve los pines a su estado inicial
GPIO.add_event_detect(sensor_1.pin, GPIO.RISING)
res=[]
i=0
while i<50000:
	if (GPIO.input(sensor_1.getPin()) == GPIO.HIGH):
        	res.append(1)
	else:
		res.append(0)
	i=i+1
print res
