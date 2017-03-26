<?php



class TestTeHelper extends \PHPUnit_Framework_TestCase
{
    private $teHelper;

    public function __construct(\DTApi\Helpers\TeHelper $teHelper)
    {
        $this->teHelper=$teHelper;
    }

    public function testWillExpireAtLessThanOrEqual90(){

        $created_at = "2017-01-01 1:26:11";
        $due_time = "2017-01-04 3:26:11";
        $result = $this->teHelper->willExpireAt($due_time,$created_at);
        $expected_result = Carbon::parse($due_time)->diffInHours(Carbon::parse($due_time))->format('Y-m-d H:i:s');
        $this->assertEquals($result,$expected_result);
    }

    public function testWillExpireAtLessThanOrEqual24(){

        $created_at = "2017-01-01 1:26:11";
        $due_time = "2017-01-02 1:25:11";
        $result = $this->teHelper->willExpireAt($due_time,$created_at);
        $expected_result = Carbon::parse($created_at)->addMinutes(90)->format("Y-m-d H:i:s");
        $this->assertEquals($result,$expected_result);
    }

    public function testWillExpireAtMoreThan24AndLessThanOrEqual72(){

        $created_at = "2017-01-01 1:26:11";
        $due_time = "2017-01-04 1:26:11";
        $result = $this->teHelper->willExpireAt($due_time,$created_at);
        $expected_result = Carbon::parse($created_at)->addHours(16)->format("Y-m-d H:i:s");
        $this->assertEquals($result,$expected_result);
    }

    public function testWillExpireAtMoreThan90(){

        $created_at = "2017-01-01 1:26:11";
        $due_time = "2017-01-05 1:26:11";
        $result = $this->teHelper->willExpireAt($due_time,$created_at);
        $expected_result = Carbon::parse($due_time)->subHours(48)->format("Y-m-d H:i:s");
        $this->assertEquals($result,$expected_result);
    }




}