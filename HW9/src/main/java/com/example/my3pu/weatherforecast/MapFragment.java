package com.example.my3pu.weatherforecast;

/**
 * Created by my3pu on 12/9/2015.
 */
// import the AerisMapView & components
import android.location.Location;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.google.android.gms.maps.model.LatLng;
import com.hamweather.aeris.communication.AerisCallback;
import com.hamweather.aeris.communication.EndpointType;
import com.hamweather.aeris.maps.AerisMapView;
import com.hamweather.aeris.maps.AerisMapView.AerisMapType;
/*import com.hamweather.aeris.maps.AerisMapView.interfaces.OnAerisMapLongClickListener;
import com.hamweather.aeris.maps.AerisMapView.OnAerisMapLongClickListener;*/
import com.hamweather.aeris.maps.MapViewFragment;
import com.hamweather.aeris.maps.interfaces.OnAerisMapLongClickListener;
import com.hamweather.aeris.maps.interfaces.OnAerisMarkerInfoWindowClickListener;
import com.hamweather.aeris.maps.markers.AerisMarker;
import com.hamweather.aeris.model.AerisResponse;
import com.hamweather.aeris.response.EarthquakesResponse;
import com.hamweather.aeris.response.FiresResponse;
import com.hamweather.aeris.response.StormCellResponse;
import com.hamweather.aeris.response.StormReportsResponse;
import com.hamweather.aeris.tiles.AerisTile;
import com.google.android.maps.*;

import org.json.JSONException;

public class MapFragment extends MapViewFragment implements
        OnAerisMapLongClickListener,OnAerisMarkerInfoWindowClickListener, AerisCallback {

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_interactive_maps, container, false);
        mapView = (AerisMapView)view.findViewById(R.id.aerisfragment_map);
        mapView.init(savedInstanceState, AerisMapType.GOOGLE);


        try {
            initMap();
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return view;
    }

    private void initMap() throws JSONException {
        Double lat = ResultActivity.json_data.getDouble("latitude");
        Double longitude =ResultActivity.json_data.getDouble("longitude");
        mapView.moveToLocation(new LatLng(ResultActivity.json_data.getDouble("latitude"),ResultActivity.json_data.getDouble("longitude")), 9);
        Log.i("Lat ", ResultActivity.json_data.getString("latitude"));
        Log.i("Lat long", ResultActivity.json_data.getString("longitude"));
        mapView.addLayer(AerisTile.RADSAT);
        mapView.setOnAerisMapLongClickListener(this);
        mapView.setOnAerisWindowClickListener(this);
    }



    @Override
    public void onMapLongClick(double lat, double longitude) {
        // code to handle map long press. i.e. Fetch current conditions?
        // see demo app MapFragment.java
    }

    @Override
    public void onResult(EndpointType endpointType, AerisResponse aerisResponse) {

    }

    @Override
    public void wildfireWindowPressed(FiresResponse firesResponse, AerisMarker aerisMarker) {

    }

    @Override
    public void stormCellsWindowPressed(StormCellResponse stormCellResponse, AerisMarker aerisMarker) {

    }

    @Override
    public void stormReportsWindowPressed(StormReportsResponse stormReportsResponse, AerisMarker aerisMarker) {

    }

    @Override
    public void earthquakeWindowPressed(EarthquakesResponse earthquakesResponse, AerisMarker aerisMarker) {

    }


    public interface OnFragmentInteractionListener {
    }
}
