<?php

namespace Database\Factories;

use App\Models\Loans;
use App\Models\Contributions;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loans>
 */
class LoansFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
     
        $loan_type =[
            'Educational',
            'Health',
            'House',
            'Financial',
        ];
        $aproval=[
            'Approved',
            'Pending',
            'Reviewing',
        ];
        $loan_status=[
            'Ongoing',
            'Paid',
        ];
        return [
            //
            'loan_type'=>$this->faker->randomElement($loan_type),
            'loan_amount'=>$this->faker->numberBetween($min = 1000, $max = 1000000000),
            // 'department'=> $this->faker->randomElement($department),
            'interest'=>$this->faker->numberBetween($min = 1000, $max=1000000),
            'approval'=>$this->faker->randomElement($aproval),
            'loan_status'=>$this->faker->randomElement($loan_status),
            'attachment_path'=>'http://3.bp.blogspot.com/_R-G_62JmanY/SCAB4RHj0_I/AAAAAAAAANQ/EGLQOelOyqo/s1600/Mapua_logo.jpg',
            // 'total_contribution'=>$this->faker->numberBetween($min = 1000, $max=1000000),
            'duration'=>$this->faker->numberBetween($min = 12, $max = 48),
        ];
    }
    public function configure(){
        return 
        $this->afterCreating(
            function(Loans $loans){
            $contribution = Contributions::factory()->make();
            $loans->contributions()->create($contribution->toArray());
            $loans->save();
        });
    }

}
