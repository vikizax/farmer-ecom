<?php

namespace App\Http\Controllers;

use App\CmsBanner;
use App\CmsBottomAd;
use App\CmsCustomerReview;
use App\CmsTopAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        switch ($request->path()) {

            case 'admin/Banner' :
                $banners = CmsBanner::get();

                return view('admin.dashboard')->with(['page' => 'bannerAll', 'banners' => $banners]);
                break;
            case 'admin/TopAd' :

                $topAds = CmsTopAd::get();

                return view('admin.dashboard')->with(['page' => 'topAdAll', 'topAds' => $topAds]);
                break;
            case 'admin/CustomerReview' :

                $reviews = CmsCustomerReview::get();

                return view('admin.dashboard')->with(['page' => 'customerReviewAll', 'reviews' => $reviews]);
                break;
            case 'admin/BottomAd' :

                $bottomAds = CmsBottomAd::get();

                return view('admin.dashboard')->with(['page' => 'bottomAdAll', 'bottomAds' => $bottomAds]);
                break;
            default:
                abort(404);
                break;
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        switch ($request->path()) {
            case 'admin/CmsBanner':
                return view('admin.dashboard')->with('page', 'bannerForm');
                break;
            case 'admin/CmsTopAd':

                return view('admin.dashboard')->with('page', 'topAdForm');
                break;
            case'admin/CmsCustomerReview':

                return view('admin.dashboard')->with('page', 'customerReviewForm');
                break;
            case 'admin/CmsBottomAd':

                return view('admin.dashboard')->with('page', 'bottomAdForm');
                break;
            case 'admin/CmsFooter':

                return view('admin.dashboard')->with('page', 'footerForm');
                break;
            default:
                abort(404);
                break;
        }


//       if(strpos($request->path(), 'CmsBanner') !== false) {
//
//           return view('admin.dashboard')->with('page', 'cmsBanner');
//       }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->path()) {
            case 'admin/CmsBannerStore' :

                $banners = CmsBanner::get();
                $banners_count = $banners->count();

                if ($banners_count == 5) {
                    return back()->with('error', 'Banner Limit exceeded! (Only 5 banner is allowed, please delete existing to add new)');
                }

                $banner_validator = Validator::make($request->all(), [
                    'title' => 'required|string',
                    'sub_title' => 'string',
                    'image' => 'required|mimes:jpg,jpeg,png|max:4096',
                    'link' => 'required'
                ], $messages = [
                    'image' => 'Please upload image only',
                ]);

                if ($banner_validator->fails()) {
                    return back()->withInput()->withErrors($banner_validator->messages());
                }

                $img_name = $request->file('image')->store('banner_image');

                CmsBanner::create([
                    'title' => $request->title,
                    'sub_title' => $request->sub_title,
                    'image' => explode('/', $img_name)[1],
                    'link' => $request->link
                ]);

                return redirect()->back()->with('success', 'Banner Added Success');

                break;
            case 'admin/CmsTopAdStore' :
                $topAds = CmsTopAd::get();
                $topAds_count = $topAds->count();

                if ($topAds_count == 2) {
                    return back()->with('error', 'Top Ads Limit exceeded! (Only 2 Top Ads is allowed, please delete existing to add new)');
                }

                $topAds_validator = Validator::make($request->all(), [
                    'ad_title' => 'required|string',
                    'image' => 'required|mimes:jpg,jpeg,png|max:4096',
                    'ad_link' => 'required'
                ], $messages = [
                    'image' => 'Please upload image only',
                ]);

                if ($topAds_validator->fails()) {
                    return back()->withInput()->withErrors($topAds_validator->messages());
                }

                $img_name = $request->file('image')->store('topAd_image');

                CmsTopAd::create([
                    'ad_title' => $request->ad_title,
                    'image' => explode('/', $img_name)[1],
                    'ad_link' => $request->ad_link
                ]);

                return redirect()->back()->with('success', 'Top Ad Added Success');

                break;
            case 'admin/CmsCustomerReviewStore' :

                $reviews_validator = Validator::make($request->all(), [
                    'review' => 'required|string|max:400',
                    'name' => 'string|required',
                    'image' => 'mimes:jpg,jpeg,png|max:4096',
                    'designation' => 'nullable|string|max:100'
                ], $messages = [
                    'image' => 'Please upload image only',
                ]);

                if ($reviews_validator->fails()) {
                    return back()->withInput()->withErrors($reviews_validator->messages());
                }

                $img_name = null;
                if ($request->hasFile('image')) {
                    $img_name = $request->file('image')->store('customer_review_image');

                }
                $data = [];

                if (is_null($img_name)) {
                    $data = [
                        'name' => $request->name,
                        'review' => $request->review,
                        'designation' => $request->designation ? $request->designation : 'Customer'
                    ];
                } else {
                    $data = [
                        'name' => $request->name,
                        'review' => $request->review,
                        'image' => explode('/', $img_name)[1],
                        'designation' =>  $request->designation ? $request->designation : 'Customer'
                    ];
                }

                CmsCustomerReview::create($data);

                return redirect()->back()->with('success', 'Customer Review Added Success');

                break;
            case 'admin/CmsBottomAdStore' :
                $bottomAds = CmsBottomAd::get();
                $bottomAds_count = $bottomAds->count();

                if ($bottomAds_count >= 4) {
                    return back()->with('error', 'Bottom Ads Limit exceeded! (Only 4 Bottom Ads is allowed, please delete existing to add new)');
                }

                $bottomAds_validator = Validator::make($request->all(), [
                    'ad_link' => 'required',
                    'image' => 'required|mimes:jpg,jpeg,png|max:4096',
                ], $messages = [
                    'image' => 'Please upload image only',
                ]);

                if ($bottomAds_validator->fails()) {
                    return back()->withInput()->withErrors($bottomAds_validator->messages());
                }

                $img_name = $request->file('image')->store('bottomAd_image');

                CmsBottomAd::create([
                    'image' => explode('/', $img_name)[1],
                    'ad_link' => $request->ad_link
                ]);

                return redirect()->back()->with('success', 'Bottom Ad Added Success');

                break;
            default:
                abort(404);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (strpos($request->path(), 'CmsBannerDelete') !== false) {

            $banner = CmsBanner::findOrFail($id);

            // delete the banner image from disk
            Storage::delete("banner_image/" . $banner->image);

            //remove the record from db
            $banner->delete();

            return back()->with('success', 'Banner remove success');
        }


        if (strpos($request->path(), 'CmsTopAdDelete') !== false) {

            $topAd = CmsTopAd::findOrFail($id);

            // delete the topAd image from disk
            Storage::delete("topAd_image/" . $topAd->image);

            //remove the record from db
            $topAd->delete();

            return back()->with('success', 'Top Ad remove success');
        }

        if (strpos($request->path(), 'CmsCustomerReviewDelete') !== false) {

            $review = CmsCustomerReview::findOrFail($id);

            // delete the customer review image from disk
            if($review->image != 'user.png') {
                Storage::delete("customer_review_image/" . $review->image);
            }

            //remove the record from db
            $review->delete();

            return back()->with('success', 'Customer Review remove success');
        }

        if (strpos($request->path(), 'CmsBottomAdDelete') !== false) {

            $bottomAd = CmsBottomAd::findOrFail($id);

            // delete the bottom ad image from disk
            Storage::delete("bottomAd_image/" . $bottomAd->image);

            //remove the record from db
            $bottomAd->delete();

            return back()->with('success', 'Bottom Ad remove success');
        }

    }
}
