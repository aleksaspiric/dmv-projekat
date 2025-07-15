<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                                                'ThermoSensor X100',
                                                'SmartPlug V2',
                                                'MotionCam 360',
                                                'AirFlow Pro',
                                                'PowerHub Mini',
                                                'EcoMeter Alpha',
                                                'TrackTag Nano',
                                            ]),
            'type' => fake()->randomElement([
                                                'Smartphone',
                                                'Tablet',
                                                'Laptop',
                                                'Smartwatch',
                                                'Router',
                                                'Sensor',
                                                'Printer',
                                                'Camera',
                                                'Speaker',
                                                'Monitor',
                                                'Smart TV',
                                                'Game Console',
                                                'Drone',
                                                'VR Headset',
                                                'Server',
                                                'Projector',
                                                'Thermostat',
                                                'Fitness Tracker',
                                                'Network Switch',
                                                'Smart Plug',
                                            ]),
            'location' => fake()->city(),
            'status' => fake()->boolean(),
            'battery' => fake()->numberBetween(0, 100)
        ];
    }
}
