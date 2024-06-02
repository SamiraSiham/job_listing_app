<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller {
    public function index() {
        // dd( request( 'tag' ) );
        return view( 'listings.index', [
            'headings' => 'Latest listings',
            'listings' => Listing::latest()->filter( request( [ 'tag', 'search' ] ) )->simplePaginate( 6 )
        ] );
    }

    public function create() {
        return view( 'listings.create' );
    }

    public function store( Request $request ) {
        $fields = $request->validate( [
            'title' => 'required',
            'company' => [ 'required', Rule::unique( 'listings', 'company' ) ],
            'location' => 'required',
            'website' => 'required',
            'email' => [ 'required', 'email' ],
            'tags' => 'required',
            'description' => 'required'
        ] );
        if ( $request->hasFile( 'logo' ) ) {
            $fields[ 'logo' ] = $request->file( 'logo' )->store( 'logos', 'public' );
        }
        $fields['user_id'] = auth()->id();
        Listing::create( $fields );
        return redirect( '/' )->with( 'message', 'Listing created successfully!' );
    }

    public function show( Listing $listing ) {
        return view( 'listings.show', [
            'listing' => $listing
        ] );
    }

    public function edit( Listing $listing ) {
        return view( 'listings.edit', [
            'listing' => $listing
        ] );
    }

    public function update( Request $request, Listing $listing ) {

        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }

        $fields = $request->validate( [
            'title' => 'required',
            'company' => 'required',
            'location' => 'required',
            'website' => 'required',
            'email' => [ 'required', 'email' ],
            'tags' => 'required',
            'description' => 'required'
        ] );
        if ( $request->hasFile( 'logo' ) ) {
            $fields[ 'logo' ] = $request->file( 'logo' )->store( 'logos', 'public' );
        }
        $listing->update( $fields );
        return back()->with( 'message', 'Listing created successfully!' );
    }

    public function destroy(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized action');
        }
        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }

}
