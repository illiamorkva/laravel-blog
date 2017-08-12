( function( $, pusher ) {

    var itemActionChannel = pusher.subscribe( 'categoryAction' );

    itemActionChannel.bind( "App\\Events\\CategoryCreated", function( data ) {

        $.notify("A new category " + data.title + " was added to the blog", "info");
    } );

} )( jQuery, pusher);