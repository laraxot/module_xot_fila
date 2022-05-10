<?php

declare(strict_types=1);

namespace Modules\Xot\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Tenant\Services\TenantService;

/**
 * Modules\Xot\Models\Profile.
 *
 * @property int                                                                  $id
 * @property string|null                                                          $created_by
 * @property string|null                                                          $updated_by
 * @property string|null                                                          $deleted_by
 * @property string|null                                                          $deleted_ip
 * @property string|null                                                          $created_ip
 * @property string|null                                                          $updated_ip
 * @property \Illuminate\Support\Carbon|null                                      $created_at
 * @property \Illuminate\Support\Carbon|null                                      $updated_at
 * @property string|null                                                          $deleted_at
 * @property string|null                                                          $premise
 * @property string|null                                                          $premise_short
 * @property string|null                                                          $locality
 * @property string|null                                                          $locality_short
 * @property string|null                                                          $postal_town
 * @property string|null                                                          $postal_town_short
 * @property string|null                                                          $administrative_area_level_3
 * @property string|null                                                          $administrative_area_level_3_short
 * @property string|null                                                          $administrative_area_level_2
 * @property string|null                                                          $administrative_area_level_2_short
 * @property string|null                                                          $administrative_area_level_1
 * @property string|null                                                          $administrative_area_level_1_short
 * @property string|null                                                          $country
 * @property string|null                                                          $country_short
 * @property string|null                                                          $street_number
 * @property string|null                                                          $street_number_short
 * @property string|null                                                          $route
 * @property string|null                                                          $route_short
 * @property string|null                                                          $postal_code
 * @property string|null                                                          $postal_code_short
 * @property string|null                                                          $googleplace_url
 * @property string|null                                                          $googleplace_url_short
 * @property string|null                                                          $point_of_interest
 * @property string|null                                                          $point_of_interest_short
 * @property string|null                                                          $political
 * @property string|null                                                          $political_short
 * @property string|null                                                          $campground
 * @property string|null                                                          $campground_short
 * @property string|null                                                          $phone
 * @property string|null                                                          $website
 * @property string|null                                                          $email
 * @property string|null                                                          $formatted_address
 * @property string|null                                                          $min_order
 * @property string|null                                                          $delivery_cost
 * @property string|null                                                          $delivery_options
 * @property int|null                                                             $order_action
 * @property string|null                                                          $price_currency
 * @property string|null                                                          $price_range
 * @property string|null                                                          $latitude
 * @property string|null                                                          $longitude
 * @property string|null                                                          $firstname
 * @property string|null                                                          $surname
 * @property string|null                                                          $address
 * @property int|null                                                             $user_id
 * @property int|null                                                             $status
 * @property string|null                                                          $guid
 * @property string|null                                                          $image_src
 * @property string|null                                                          $lang
 * @property string|null                                                          $post_type
 * @property string|null                                                          $subtitle
 * @property string|null                                                          $title
 * @property string|null                                                          $txt
 * @property string|null                                                          $user_handle
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Xot\Models\Image[] $images
 * @property int|null                                                             $images_count
 * @property \Modules\Lang\Models\Post|null                                       $post
 * @property \Illuminate\Database\Eloquent\Collection|\Modules\Lang\Models\Post[] $posts
 * @property int|null                                                             $posts_count
 * @property mixed                                                                $url
 * @property \Modules\LU\Models\User|null                                         $user
 *
 * @method static \Modules\Xot\Database\Factories\ProfileFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang ofItem(string $guid)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile query()
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel1Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel2Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereAdministrativeAreaLevel3Short($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCampground($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCampgroundShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCountryShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereCreatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeletedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeliveryCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereDeliveryOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereFormattedAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGoogleplaceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereGoogleplaceUrlShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLocalityShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereMinOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereOrderAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePointOfInterest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePointOfInterestShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePolitical($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePoliticalShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalCodeShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalTown($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostalTownShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePremise($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePremiseShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePriceCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePriceRange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereRoute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereRouteShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStreetNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereStreetNumberShort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUpdatedIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BaseModelLang withPost(string $guid)
 * @mixin \Eloquent
 *
 * @property string|null $bio
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Profile whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Profile wherePostType($value)
 * @mixin IdeHelperProfile
 */
class Profile extends BaseModelLang {
    /**
     * @var string[]
     */
    protected $fillable = ['id', 'user_id'];

    /**
     * Undocumented function.
     */
    public function user(): BelongsTo {
        $user = TenantService::model('user');
        $user_class = \get_class($user);

        return $this->belongsTo($user_class);
    }
}
