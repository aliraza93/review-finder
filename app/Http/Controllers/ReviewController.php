<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ReviewController extends Controller
{
    public function getReviews(Request $request)
    {
        $url = $request->query('url');

        // Validate URL
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'query' => ['Invalid URL']
                ]
            ], 422);
        }

        // Choose API based on URL
        if (strpos($url, 'airbnb.com') !== false || strpos($url, 'airbnb.de') !== false) {
            // Extract listing ID from URL
            $listingId = null;

            // Find the position of 'rooms/' in the URL
            $pos = strpos($url, 'rooms/');
            if ($pos !== false) {
                // Extract the substring after 'rooms/'
                $listingId = substr($url, $pos + strlen('rooms/'));
                // Find the position of any character that terminates the ID (like '?')
                $endPos = strpos($listingId, '?');
                if ($endPos !== false) {
                    // Trim any additional parameters after the ID
                    $listingId = substr($listingId, 0, $endPos);
                }
            }

            // Check if a valid listing ID was extracted
            if (!$listingId) {
                return response()->json([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'query' => ['Invalid or unsupported URL format for Airbnb']
                    ]
                ], 422);
            }

            // Choose API based on URL
            $pageNumber = 1;
            $reviews = $this->fetchAirbnbReviews($listingId, $pageNumber);
            return $reviews;
        } elseif (strpos($url, 'booking.com') !== false) {
            return $this->fetchBookingReviews($url);
        } else {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'query' => ['Invalid URL']
                ]
            ], 422);
        }
    }

    private function fetchAirbnbReviews($listingId, $pageNumber)
    {
        $apiKey = config('rapidapi.key');
        
        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->request('GET', 'https://airbnb45.p.rapidapi.com/api/v1/getPropertyReviews', [
                'headers' => [
                    'x-rapidapi-host' => 'airbnb45.p.rapidapi.com',
                    'x-rapidapi-key' => $apiKey,
                ],
                'query' => [
                    'propertyId' => $listingId,
                    'page' => $pageNumber,
                ],
            ]);

            $responseData = json_decode($response->getBody(), true);

            return response()->json($responseData, 200, [], JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch Airbnb reviews.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    private function fetchBookingReviews($url)
    {
        $apiKey = 'ace4ae5402mshe96807481202d80p1d71a4jsn3e752df9c9b4'; // Replace with your RapidAPI key

        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://booking-com15.p.rapidapi.com/api/v1/hotels/getHotelReviewsFilterMetadata?hotel_id=1377073&languagecode=en-us', [
            'headers' => [
                'x-rapidapi-host' => 'booking-com15.p.rapidapi.com',
                'x-rapidapi-key' => 'ace4ae5402mshe96807481202d80p1d71a4jsn3e752df9c9b4',
            ],
        ]);

        $responseData = json_decode($response->getBody(), true);

        return response()->json($responseData, 200, [], JSON_PRETTY_PRINT);
    }
}
