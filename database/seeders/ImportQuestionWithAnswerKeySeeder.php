<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImportQuestionWithAnswerKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What documents are required for solo flight?',
                'answer_choices' => [
                    ['answer_text' => 'Student pilot certificate, government-issued photo ID, medical certificate, and logbook with instructor endorsement for solo flight.', 'is_correct' => true],
                    ['answer_text' => 'Flight training manual and instructor ID.', 'is_correct' => false],
                    ['answer_text' => 'Passport and flight instructor ID.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What are the limitations of a student pilot flying solo?',
                'answer_choices' => [
                    ['answer_text' => 'A student pilot may not carry passengers, fly for hire, fly in furtherance of a business, fly in Class B airspace without endorsement, or fly internationally.', 'is_correct' => true],
                    ['answer_text' => 'A student pilot can fly anytime with passengers.', 'is_correct' => false],
                    ['answer_text' => 'A student pilot can only fly in daylight.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the minimum visibility required for a student pilot to fly solo in controlled airspace?',
                'answer_choices' => [
                    ['answer_text' => '3 statute miles.', 'is_correct' => true],
                    ['answer_text' => '5 statute miles.', 'is_correct' => false],
                    ['answer_text' => '1 statute mile.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What are the required fuel reserves for a VFR flight during the day?',
                'answer_choices' => [
                    ['answer_text' => 'Enough fuel to fly to the first point of landing plus 30 minutes of extra fuel at normal cruising speed.', 'is_correct' => true],
                    ['answer_text' => 'Only enough fuel to reach the destination.', 'is_correct' => false],
                    ['answer_text' => '1 hour of fuel reserve.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the required altitude to fly over congested areas?',
                'answer_choices' => [
                    ['answer_text' => '1,000 feet above the highest obstacle within a 2,000-foot radius.', 'is_correct' => true],
                    ['answer_text' => '500 feet above the highest obstacle.', 'is_correct' => false],
                    ['answer_text' => '2,000 feet above ground level.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the minimum safe altitude for flying over non-congested areas?',
                'answer_choices' => [
                    ['answer_text' => '500 feet above the surface, except over water or sparsely populated areas.', 'is_correct' => true],
                    ['answer_text' => '1,000 feet above the surface.', 'is_correct' => false],
                    ['answer_text' => '1,500 feet above ground level.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'Explain the “4 Cs” when you get lost.',
                'answer_choices' => [
                    ['answer_text' => 'Climb, Communicate, Confess, and Comply.', 'is_correct' => true],
                    ['answer_text' => 'Call, Confirm, Continue, and Comply.', 'is_correct' => false],
                    ['answer_text' => 'Calculate, Change, Communicate, and Comply.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the procedure for entering a traffic pattern?',
                'answer_choices' => [
                    ['answer_text' => 'Enter at a 45-degree angle to the downwind leg at traffic pattern altitude.', 'is_correct' => true],
                    ['answer_text' => 'Enter directly on the base leg.', 'is_correct' => false],
                    ['answer_text' => 'Enter at a 90-degree angle to the final approach.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the transponder code for VFR flight?',
                'answer_choices' => [
                    ['answer_text' => '1200.', 'is_correct' => true],
                    ['answer_text' => '7500.', 'is_correct' => false],
                    ['answer_text' => '2000.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do if you experience an engine failure in flight?',
                'answer_choices' => [
                    ['answer_text' => 'Establish best glide speed, find a suitable landing spot, troubleshoot the engine, communicate your emergency, and prepare for landing.', 'is_correct' => true],
                    ['answer_text' => 'Ignore the issue and continue flying.', 'is_correct' => false],
                    ['answer_text' => 'Immediately descend to the ground.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the maximum flap extension speed (Vfe)?',
                'answer_choices' => [
                    ['answer_text' => 'Varies by aircraft; refer to the Pilot Operating Handbook (POH).', 'is_correct' => true],
                    ['answer_text' => 'Always 100 knots.', 'is_correct' => false],
                    ['answer_text' => 'Always 120 knots.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What does Vno represent?',
                'answer_choices' => [
                    ['answer_text' => 'Maximum structural cruising speed, above which the aircraft should only be flown in smooth air.', 'is_correct' => true],
                    ['answer_text' => 'Stalling speed in a clean configuration.', 'is_correct' => false],
                    ['answer_text' => 'Minimum safe speed for takeoff.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the maximum allowable crosswind component for solo flight?',
                'answer_choices' => [
                    ['answer_text' => 'This is set by your instructor and depends on the aircraft, often found in the POH or your endorsement.', 'is_correct' => true],
                    ['answer_text' => '15 knots for all aircraft.', 'is_correct' => false],
                    ['answer_text' => '25 knots for all aircraft.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What action should you take if you encounter wind shear during landing?',
                'answer_choices' => [
                    ['answer_text' => 'Go around if the landing is unsafe, and adjust your airspeed to compensate for wind conditions.', 'is_correct' => true],
                    ['answer_text' => 'Continue the landing approach without changing anything.', 'is_correct' => false],
                    ['answer_text' => 'Increase speed and descend quickly.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'How should you recover from a stall?',
                'answer_choices' => [
                    ['answer_text' => 'Lower the nose to reduce the angle of attack, apply full power, and return to level flight.', 'is_correct' => true],
                    ['answer_text' => 'Pull back on the yoke and maintain altitude.', 'is_correct' => false],
                    ['answer_text' => 'Increase drag and bank the aircraft.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the minimum distance you should stay away from thunderstorms?',
                'answer_choices' => [
                    ['answer_text' => 'At least 20 nautical miles, as thunderstorms can produce severe turbulence and lightning.', 'is_correct' => true],
                    ['answer_text' => 'At least 10 nautical miles.', 'is_correct' => false],
                    ['answer_text' => 'At least 5 nautical miles.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'When should you use carburetor heat?',
                'answer_choices' => [
                    ['answer_text' => 'When the engine is running rough, especially during descent or when flying in moist air conditions.', 'is_correct' => true],
                    ['answer_text' => 'Whenever you start the engine.', 'is_correct' => false],
                    ['answer_text' => 'Only on takeoff.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the primary purpose of a preflight inspection?',
                'answer_choices' => [
                    ['answer_text' => 'To ensure the aircraft is airworthy and free from defects before flight.', 'is_correct' => true],
                    ['answer_text' => 'To impress the instructor.', 'is_correct' => false],
                    ['answer_text' => 'To collect flight data.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do if you are unsure about the weather conditions at your destination?',
                'answer_choices' => [
                    ['answer_text' => 'Obtain updated weather information and consider delaying your flight if conditions are unsafe.', 'is_correct' => true],
                    ['answer_text' => 'Continue with the flight without checking.', 'is_correct' => false],
                    ['answer_text' => 'Fly at a lower altitude to avoid bad weather.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a NOTAM?',
                'answer_choices' => [
                    ['answer_text' => 'To provide information about the condition of airports, airspace, and hazards to pilots.', 'is_correct' => true],
                    ['answer_text' => 'To announce new regulations.', 'is_correct' => false],
                    ['answer_text' => 'To communicate weather forecasts.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is an AIRMET?',
                'answer_choices' => [
                    ['answer_text' => 'A weather advisory that warns of potentially hazardous conditions for small aircraft.', 'is_correct' => true],
                    ['answer_text' => 'A weather forecast for all aircraft.', 'is_correct' => false],
                    ['answer_text' => 'A summary of weather reports.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a flight plan?',
                'answer_choices' => [
                    ['answer_text' => 'To inform air traffic control of your intended route and provide a means for search and rescue.', 'is_correct' => true],
                    ['answer_text' => 'To request permission to take off.', 'is_correct' => false],
                    ['answer_text' => 'To notify your instructor about your flight.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the function of the pitot tube?',
                'answer_choices' => [
                    ['answer_text' => 'To measure dynamic air pressure for airspeed indication.', 'is_correct' => true],
                    ['answer_text' => 'To measure altitude.', 'is_correct' => false],
                    ['answer_text' => 'To measure vertical speed.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What type of airspace requires a transponder with Mode C?',
                'answer_choices' => [
                    ['answer_text' => 'Class B airspace.', 'is_correct' => true],
                    ['answer_text' => 'Class D airspace.', 'is_correct' => false],
                    ['answer_text' => 'Class E airspace.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of the altimeter?',
                'answer_choices' => [
                    ['answer_text' => 'To measure the aircraft’s altitude above sea level.', 'is_correct' => true],
                    ['answer_text' => 'To measure the aircraft’s speed.', 'is_correct' => false],
                    ['answer_text' => 'To measure vertical speed.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the importance of maintaining a proper weight and balance in an aircraft?',
                'answer_choices' => [
                    ['answer_text' => 'It affects the aircraft’s performance, stability, and control.', 'is_correct' => true],
                    ['answer_text' => 'It is not important as long as the aircraft can take off.', 'is_correct' => false],
                    ['answer_text' => 'It only matters for commercial flights.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do before refueling an aircraft?',
                'answer_choices' => [
                    ['answer_text' => 'Ensure the aircraft is grounded and check fuel quality.', 'is_correct' => true],
                    ['answer_text' => 'Start refueling immediately.', 'is_correct' => false],
                    ['answer_text' => 'Call for assistance first.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the significance of the white arc on the airspeed indicator?',
                'answer_choices' => [
                    ['answer_text' => 'It indicates the flap operating range.', 'is_correct' => true],
                    ['answer_text' => 'It indicates the stall speed.', 'is_correct' => false],
                    ['answer_text' => 'It indicates the maximum speed for landing.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What does the yellow arc on the airspeed indicator signify?',
                'answer_choices' => [
                    ['answer_text' => 'Caution range; do not fly in this range unless necessary.', 'is_correct' => true],
                    ['answer_text' => 'Normal operating range.', 'is_correct' => false],
                    ['answer_text' => 'Stall range.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is a crosswind component?',
                'answer_choices' => [
                    ['answer_text' => 'The part of the wind that is perpendicular to the runway direction.', 'is_correct' => true],
                    ['answer_text' => 'The total wind speed.', 'is_correct' => false],
                    ['answer_text' => 'The wind speed along the runway.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do if you see a traffic conflict ahead?',
                'answer_choices' => [
                    ['answer_text' => 'Communicate your intentions and take evasive action if necessary.', 'is_correct' => true],
                    ['answer_text' => 'Ignore it and continue on your path.', 'is_correct' => false],
                    ['answer_text' => 'Turn around immediately.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a safety pilot?',
                'answer_choices' => [
                    ['answer_text' => 'To provide assistance and guidance during flight when the primary pilot is not fully proficient.', 'is_correct' => true],
                    ['answer_text' => 'To take control of the aircraft.', 'is_correct' => false],
                    ['answer_text' => 'To record flight data.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is an emergency landing procedure?',
                'answer_choices' => [
                    ['answer_text' => 'Identify a landing area, configure the aircraft for landing, communicate your intentions, and execute the landing safely.', 'is_correct' => true],
                    ['answer_text' => 'Continue flying until the engine fails completely.', 'is_correct' => false],
                    ['answer_text' => 'Land at the nearest airport regardless of conditions.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of using a checklist?',
                'answer_choices' => [
                    ['answer_text' => 'To ensure all steps and safety procedures are followed before, during, and after the flight.', 'is_correct' => true],
                    ['answer_text' => 'To impress passengers.', 'is_correct' => false],
                    ['answer_text' => 'To record flight times.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'When should you perform a go-around?',
                'answer_choices' => [
                    ['answer_text' => 'When the landing approach is unstable or if there is a hazard on the runway.', 'is_correct' => true],
                    ['answer_text' => 'Whenever you feel uncertain about landing.', 'is_correct' => false],
                    ['answer_text' => 'Only when instructed by air traffic control.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What does "pitch" refer to in aircraft control?',
                'answer_choices' => [
                    ['answer_text' => 'The angle of the aircraft’s nose relative to the horizon.', 'is_correct' => true],
                    ['answer_text' => 'The rotation around the vertical axis.', 'is_correct' => false],
                    ['answer_text' => 'The direction of movement relative to the ground.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the function of the ailerons?',
                'answer_choices' => [
                    ['answer_text' => 'To control roll by moving the wings up or down.', 'is_correct' => true],
                    ['answer_text' => 'To control pitch.', 'is_correct' => false],
                    ['answer_text' => 'To control yaw.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do if the engine fails during takeoff?',
                'answer_choices' => [
                    ['answer_text' => 'Pitch for the best glide speed and select a landing area.', 'is_correct' => true],
                    ['answer_text' => 'Attempt to restart the engine immediately.', 'is_correct' => false],
                    ['answer_text' => 'Continue the takeoff as if nothing happened.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the function of the rudder?',
                'answer_choices' => [
                    ['answer_text' => 'To control yaw and help maintain coordinated flight.', 'is_correct' => true],
                    ['answer_text' => 'To control pitch.', 'is_correct' => false],
                    ['answer_text' => 'To control roll.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of the throttle?',
                'answer_choices' => [
                    ['answer_text' => 'To control the engine power and speed of the aircraft.', 'is_correct' => true],
                    ['answer_text' => 'To control the aircraft\'s altitude.', 'is_correct' => false],
                    ['answer_text' => 'To control the direction of flight.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'When should you use flaps during landing?',
                'answer_choices' => [
                    ['answer_text' => 'To increase lift and decrease stall speed during the landing approach.', 'is_correct' => true],
                    ['answer_text' => 'Only when landing on short runways.', 'is_correct' => false],
                    ['answer_text' => 'Never, as it can cause a stall.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a stall warning system?',
                'answer_choices' => [
                    ['answer_text' => 'To alert the pilot before the aircraft stalls.', 'is_correct' => true],
                    ['answer_text' => 'To provide altitude information.', 'is_correct' => false],
                    ['answer_text' => 'To assist with navigation.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the function of the elevator?',
                'answer_choices' => [
                    ['answer_text' => 'To control pitch and maintain the aircraft’s attitude.', 'is_correct' => true],
                    ['answer_text' => 'To control roll.', 'is_correct' => false],
                    ['answer_text' => 'To control yaw.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the role of the vertical stabilizer?',
                'answer_choices' => [
                    ['answer_text' => 'To provide directional stability and control yaw.', 'is_correct' => true],
                    ['answer_text' => 'To control pitch.', 'is_correct' => false],
                    ['answer_text' => 'To increase lift.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do during a power-off landing?',
                'answer_choices' => [
                    ['answer_text' => 'Maintain best glide speed and find a suitable landing area.', 'is_correct' => true],
                    ['answer_text' => 'Attempt to restart the engine immediately.', 'is_correct' => false],
                    ['answer_text' => 'Land in the first open field you see.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the function of the landing gear?',
                'answer_choices' => [
                    ['answer_text' => 'To support the aircraft during takeoff, landing, and ground operations.', 'is_correct' => true],
                    ['answer_text' => 'To control the aircraft’s speed.', 'is_correct' => false],
                    ['answer_text' => 'To stabilize the aircraft in the air.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of conducting a weight and balance check before flight?',
                'answer_choices' => [
                    ['answer_text' => 'To ensure the aircraft is within its weight limits for safe operation.', 'is_correct' => true],
                    ['answer_text' => 'To check the fuel levels.', 'is_correct' => false],
                    ['answer_text' => 'To prepare the flight plan.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the procedure for a short field takeoff?',
                'answer_choices' => [
                    ['answer_text' => 'Use full power, rotate at the appropriate speed, and climb out at the best angle of climb speed.', 'is_correct' => true],
                    ['answer_text' => 'Take off as you would on a normal runway.', 'is_correct' => false],
                    ['answer_text' => 'Use less power to avoid over-rotation.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a go-around?',
                'answer_choices' => [
                    ['answer_text' => 'To discontinue the landing approach due to unstable conditions or hazards.', 'is_correct' => true],
                    ['answer_text' => 'To practice landing maneuvers.', 'is_correct' => false],
                    ['answer_text' => 'To land at a different airport.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the recommended action if you encounter wake turbulence during landing?',
                'answer_choices' => [
                    ['answer_text' => 'Go around and avoid landing until the turbulence has dissipated.', 'is_correct' => true],
                    ['answer_text' => 'Continue landing as normal.', 'is_correct' => false],
                    ['answer_text' => 'Attempt to land faster to overcome the turbulence.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the significance of the green arc on the airspeed indicator?',
                'answer_choices' => [
                    ['answer_text' => 'It indicates the normal operating range for the aircraft.', 'is_correct' => true],
                    ['answer_text' => 'It indicates the stall speed.', 'is_correct' => false],
                    ['answer_text' => 'It indicates the maximum speed for landing.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the proper technique for recovering from a stall?',
                'answer_choices' => [
                    ['answer_text' => 'Lower the nose to reduce angle of attack and apply full power if appropriate.', 'is_correct' => true],
                    ['answer_text' => 'Pull back on the yoke to regain altitude.', 'is_correct' => false],
                    ['answer_text' => 'Increase the flaps to gain lift.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What does the term "yaw" refer to in aircraft control?',
                'answer_choices' => [
                    ['answer_text' => 'The rotation around the vertical axis of the aircraft.', 'is_correct' => true],
                    ['answer_text' => 'The upward or downward tilt of the aircraft.', 'is_correct' => false],
                    ['answer_text' => 'The forward or backward movement of the aircraft.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do if you encounter an engine failure in flight?',
                'answer_choices' => [
                    ['answer_text' => 'Establish best glide speed and find a suitable landing area.', 'is_correct' => true],
                    ['answer_text' => 'Attempt to restart the engine immediately.', 'is_correct' => false],
                    ['answer_text' => 'Land immediately without considering options.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a pre-flight check?',
                'answer_choices' => [
                    ['answer_text' => 'To ensure the aircraft is airworthy and ready for flight.', 'is_correct' => true],
                    ['answer_text' => 'To review the flight plan.', 'is_correct' => false],
                    ['answer_text' => 'To prepare for landing.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the recommended action if an aircraft encounters icing conditions?',
                'answer_choices' => [
                    ['answer_text' => 'Avoid flying in icing conditions and consider descending to a lower altitude.', 'is_correct' => true],
                    ['answer_text' => 'Continue flying as normal.', 'is_correct' => false],
                    ['answer_text' => 'Attempt to climb to a higher altitude.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do if you experience a fuel emergency?',
                'answer_choices' => [
                    ['answer_text' => 'Land at the nearest suitable airport.', 'is_correct' => true],
                    ['answer_text' => 'Circle the airport until you run out of fuel.', 'is_correct' => false],
                    ['answer_text' => 'Fly to your intended destination regardless of fuel levels.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a cockpit checklist?',
                'answer_choices' => [
                    ['answer_text' => 'To ensure all necessary procedures are completed for safe operation.', 'is_correct' => true],
                    ['answer_text' => 'To keep track of fuel consumption.', 'is_correct' => false],
                    ['answer_text' => 'To prepare for takeoff.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What does "roll" refer to in aircraft control?',
                'answer_choices' => [
                    ['answer_text' => 'The rotation around the aircraft’s longitudinal axis.', 'is_correct' => true],
                    ['answer_text' => 'The upward or downward tilt of the aircraft.', 'is_correct' => false],
                    ['answer_text' => 'The forward or backward movement of the aircraft.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the recommended altitude for cruising in general aviation?',
                'answer_choices' => [
                    ['answer_text' => 'Between 3,000 and 10,000 feet for most aircraft.', 'is_correct' => true],
                    ['answer_text' => 'Above 10,000 feet only.', 'is_correct' => false],
                    ['answer_text' => 'Below 3,000 feet only.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What should you do before entering a runway?',
                'answer_choices' => [
                    ['answer_text' => 'Ensure that it is clear of other aircraft and obstacles.', 'is_correct' => true],
                    ['answer_text' => 'Proceed without stopping.', 'is_correct' => false],
                    ['answer_text' => 'Check the weather conditions only.', 'is_correct' => false],
                ]
            ],
            [
                'quiz_id' => 1,
                'category_id' => 1,
                'question_text' => 'What is the purpose of a stall recovery procedure?',
                'answer_choices' => [
                    ['answer_text' => 'To regain control of the aircraft after a stall condition.', 'is_correct' => true],
                    ['answer_text' => 'To increase altitude.', 'is_correct' => false],
                    ['answer_text' => 'To prepare for landing.', 'is_correct' => false],
                ]
            ],
        ];

        // Insert the questions into the database
        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'quiz_id' => $question['quiz_id'],
                // 'category_id' => $question['category_id'],
                'question_text' => $question['question_text'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $questionId = DB::getPdo()->lastInsertId();

            foreach ($question['answer_choices'] as $answer) {
                DB::table('answers')->insert([
                    'question_id' => $questionId,
                    'answer_text' => $answer['answer_text'],
                    'is_correct' => $answer['is_correct'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
