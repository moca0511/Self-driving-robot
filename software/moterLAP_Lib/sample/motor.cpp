//g++ motor.cpp pwmLAP.cpp encoder.cpp -lwiringPi

#include "pwmLAP.h"
#include "encoder.h"

#define ROTARY_ENCODER_1A 20
#define ROTARY_ENCODER_1B 18

//エンコーダの複数受信テストで利用したGPIOピン
//2つの受信パルスは同一にならなかった
//#define ROTARY_ENCODER_2A 22
//#define ROTARY_ENCODER_2B 27

#define PWM_PIN1 5
#define DIR_PIN1 12

int main(void)
{
	if (wiringPiSetupGpio() == -1)
		return 1;
	MoterDriver10A motor1(PWM_PIN1, DIR_PIN1);
	Encoder encoder1(ROTARY_ENCODER_1A, ROTARY_ENCODER_1B, 0);

	sleep(1);

	printf("スタートパルス:	%d\n", encoder1.readRaw());
	//低速半回転
	motor1.rotation(128 - 50);
	while (abs(encoder1.readRaw()) <= 374 / 2)
	{
		//encoder1.print();
	}
	motor1.stop();
	printf("動作終了時パルス:	%d\n", encoder1.readRaw());
	sleep(1);
	printf("制動動作分パルス:	%d\n\n", encoder1.readRaw());
	sleep(1);

	//高速正回転
	motor1.rotation(128 - 80);
	while (abs(encoder1.readRaw()) <= 374)
	{
		//encoder1.print();
	}
	motor1.stop();
	printf("動作終了時パルス:	%d\n", encoder1.readRaw());
	sleep(1);
	printf("制動動作分パルス:	%d\n\n", encoder1.readRaw());
	sleep(1);

	encoder1.init();
	printf("re:スタートパルス:	%d\n", encoder1.readRaw());
	sleep(1);

	//高速逆回転
	motor1.rotation(128 + 80);
	while (abs(encoder1.readRaw()) <= 374)
	{
		//encoder1.print();
	}
	motor1.stop();

	printf("動作終了時パルス:	%d\n", encoder1.readRaw());
	sleep(1);
	printf("制動動作分パルス:	%d\n\n", encoder1.readRaw());
	sleep(1);
	
	motor1.sleep();
	sleep(1);
	printf("最終パルス:	%d\n", encoder1.readRaw());
	return 0;
}
