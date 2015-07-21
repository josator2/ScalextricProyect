#include <stdio.h>    // Used for printf() statements
#include <wiringPi.h> // Include WiringPi library!
#include <time.h>
#include <unistd.h>
#include <math.h>
#include <pthread.h>

void *loopThread ( void *ptr );

typedef struct str_data{
        int pin;
        struct timespec start, end;
        unsigned long int time;
        double distance;
        double speed;
}thdata;


int main(void)
{

        // Setup stuff:
        wiringPiSetupGpio(); // Initialize wiringPi -- using Broadcom pin numbers

        pthread_t thread1, thread2;  /* thread variables */
        thdata data, data1, data2;         /* structs to be passed to threads */

        /* initialize data to pass to main thread  */
        data.pin=21;
        data.distance=5;

        /* initialize data to pass to thread 1 */
        data1.pin=20;
        data1.distance=5;

        /* initialize data to pass to thread 2 */
        data2.pin=16;
        data2.distance=5;

        pthread_create (&thread1, NULL, &loopThread, &data1);
        pthread_create (&thread2, NULL, &loopThread, &data2);

        pinMode(data.pin, INPUT); // Set PWM SENSOR as PWM input
        //pullUpDnControl(pin, PUD_UP); // Enable pull-up resistor on button
	while(1){

                while(!digitalRead(data.pin)){
                        usleep(500);
                }
                clock_gettime(CLOCK_REALTIME,&data.start);
                while(digitalRead(data.pin)){
                        usleep(500);
                }
        	clock_gettime(CLOCK_REALTIME,&data.end);
        	data.time=data.end.tv_sec*1000000000+data.end.tv_nsec-(data.start.tv_sec*1000000000+data.start.tv_nsec);

        	printf("speed %d: %lf \n",data.pin,data.speed=data.distance*pow(10,7)*3.6/data.time);
        }
	return 0;
}

void *loopThread ( void *ptr ){
        thdata *data;
        data =(thdata *) ptr; /* type cast to a pointer to thdata */
	pinMode(data->pin, INPUT);
        while(1){

                while(!digitalRead(data->pin)){
                        usleep(500);
                }
                clock_gettime(CLOCK_REALTIME,&data->start);
                while(digitalRead(data->pin)){
                        usleep(500);
                }
        	clock_gettime(CLOCK_REALTIME,&data->end);
        	data->time=data->end.tv_sec*1000000000+data->end.tv_nsec-(data->start.tv_sec*1000000000+data->start.tv_nsec);

	        printf("speed %d: %lf \n",data->pin,data->speed=data->distance*pow(10,7)*3.6/data->time);
	}
	pthread_exit(0);
}

