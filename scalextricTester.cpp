#include <stdio.h>    // Used for printf() statements
#include <wiringPi.h> // Include WiringPi library!
#include <time.h>
#include <unistd.h>
// Pin number declarations. We're using the Broadcom chip pin numbers.
const int pin = 21; // PWM LED - Broadcom pin 18, P1 pin 12

int main(void)
{
    // Setup stuff:
    wiringPiSetupGpio(); // Initialize wiringPi -- using Broadcom pin numbers

    pinMode(pin, INPUT); // Set PWM SENSOR as PWM input
    //pullUpDnControl(pin, PUD_UP); // Enable pull-up resistor on button

    printf("blinker is running! Press CTRL+C to quit.");

    struct timespec start, end;

    // Loop (while(1)):
double time;
bool aux;
while(1){
	
	while(aux=!digitalRead(pin)){
		printf("aire 0: %d\n",aux);
		usleep(500);
	}
	//clock_gettime(CLOCK_REALTIME,&start);
	while(aux=digitalRead(pin)){
		usleep(500);
		printf("coche1: %d\n",aux);
	}
	printf("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa");
	//clock_gettime(CLOCK_REALTIME,&end);
	//time=end.tv_sec*1000000000+end.tv_nsec-(start.tv_sec*1000000000+start.tv_nsec);
	//printf("time: %lf \n",time);
}
    return 0;
}

