<?php

namespace Towa\SDK\Bookingcom\Test;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use Towa\SDK\Bookingcom\Repository\Hotel_Repository;
use Towa\SDK\Bookingcom\Repository\City_Repository;
use Towa\SDK\Bookingcom\Model\Hotel;
use Towa\SDK\Bookingcom\Model\Hotel_Type;

class HotelRepositoryTest extends TestCase
{
    /** @var \Towa\SDK\Bookingcom\Repository\Hotel_Repository */
    protected $hotelRepo;

    public function setUp()
    {
        $dotenv = new Dotenv(\dirname(__DIR__, 1));
        $dotenv->load();

        $this->hotelRepo = new Hotel_Repository($_ENV['USERNAME'], $_ENV['PASSWORD']);

        parent::setUp();
    }

    /** @test */
    public function it_can_get_hotels_by_cityId()
    {
        $hotels = $this->hotelRepo->get_hotels(
            [
                'city_ids' => -1991244,
            ],
            'en'
        );

        $this->assertNotEmpty($hotels);
    }

    /** @test */
    public function it_can_get_hotel_by_id()
    {
        $hotels = $this->hotelRepo->get_hotels(
            [
                'hotel_ids' => 28546,
                'extras' => 'hotel_info',
            ],
            'en'
        );
      
        $hotel = $hotels;

        $this->assertNotEmpty($hotel);
        $this->assertCount(1, [$hotels]);
    }

    /** @test */
    public function it_can_get_hotel_by_countryId()
    {
        $hotels = $this->hotelRepo->get_hotels(
            [
                'country_ids' => 'at',
            ],
            'en'
        );
      
        $hotel = $hotels;
        $this->assertNotEmpty($hotel);
        $this->assertCount(1, [$hotels]);
    }

    /** @test */
    public function it_can_get_hotel_by_districtId()
    {
        $hotels = $this->hotelRepo->get_hotels(
            [
                'district_ids' => 273,
            ],
            'en'
        );

        $hotel = $hotels;
        $this->assertNotEmpty($hotel);
        $this->assertCount(1, [$hotels]);
    }

    /** @test */
    public function it_can_get_hotel_by_regionId()
    {
        $hotels = $this->hotelRepo->get_hotels(
                [
                    'region_ids' => 606,
                ],
                'en'
            );
          
        $hotel = $hotels;
        $this->assertNotEmpty($hotel);
        $this->assertCount(1, [$hotels]);
        // $this->assertInstanceOf(Hotel::class, $hotels);
    }
}
