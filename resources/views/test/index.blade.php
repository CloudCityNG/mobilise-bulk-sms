@extends('layouts.master')

@section('content')
    <div class="col-md-9 col-md-offset-3">
        <div class="text-blue">
            Test.index
        </div>

        <script type="text/x-handlebars" data-template-name="artists">
          <div class="col-md-4">
            <div class="list-group">
              @{{#each model}}
                @{{#link-to "artists.songs" this class="list-group-item artist-link"}}
                  @{{name}}
                  <span class="pointer glyphicon glyphicon-chevron-right"></span>
                @{{/link-to}}
              @{{/each}}
            </div>
          </div>
          <div class="col-md-8">
            <div class="list-group">
              @{{outlet}}
            </div>
          </div>
        </script>
        <script type="text/x-handlebars" data-template-name="artists/index">
          <div class="list-group-item empty-list">
            <div class="empty-message">
              Select an artist.
            </div>
          </div>
        </script>
    </div>
@stop

@section('foot')
@parent
<script src="/js/handlebars-v3.0.0.js"></script>
<script src="http://builds.emberjs.com/tags/v1.11.1/ember.debug.js"></script>
<script src="http://builds.emberjs.com/tags/v1.0.0-beta.16/ember-data.min.js"></script>
<script src="http://builds.emberjs.com/tags/v1.11.1/ember-template-compiler.js"></script>
<script>
App = Ember.Application.create();

App.Router.map(function() {
    this.route('about', { path: '/about' });    //this /about renders about template
    this.route('favorites', { path: '/favs' }); //this /favs renders favorites template
  this.resource('artists', function() {
    this.route('songs', { path: ':slug' });
  });
});

App.ArtistsRoute = Ember.Route.extend({
  model: function() {
    var artistObjects = [];
    Ember.$.getJSON('http://lara.app/artists', function(artists) {
      artists.forEach(function(data) {
        artistObjects.pushObject(App.Artist.createRecord(data));
      });
    });
    return artistObjects;
  }
});
</script>
@endsection