package com.example.my3pu.weatherforecast;

import android.app.Activity;
import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.media.MediaActionSound;
import android.net.Uri;
import android.os.Bundle;
import android.text.Html;
import android.text.format.DateFormat;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.facebook.CallbackManager;
import com.facebook.FacebookCallback;
import com.facebook.FacebookException;
import com.facebook.FacebookSdk;
import com.facebook.share.Sharer;
import com.facebook.share.model.ShareLinkContent;
import com.facebook.share.widget.ShareDialog;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.InputStreamReader;
import java.io.PrintStream;
import java.io.Serializable;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.Locale;
import java.util.TimeZone;

public class ResultActivity extends Activity implements View.OnClickListener {
    static JSONObject json_data = null;
    String JSON_data = null;
    JSONObject jcurrently = null;
    CallbackManager callbackManager;
    ShareDialog shareDialog;
    @Override
    protected void onCreate(Bundle savedInstanceState) {

        Bundle bundle = getIntent().getExtras();
        JSON_data = bundle.getString("JSONData");

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_result);
        String latitude =  null,icon =null;
        JSONObject jresponse = null;

        try {
            jresponse = new JSONObject(JSON_data);
            json_data = jresponse;
        } catch (JSONException e) {
            e.printStackTrace();
        }
        try {

            jcurrently = jresponse.getJSONObject("currently");
            JSONObject jdaily = jresponse.getJSONObject("daily");
            JSONArray jdata = jdaily.getJSONArray("data");
            icon = jcurrently.getString("icon");
            ImageView imageview = (ImageView)findViewById(R.id.daily_image);
            int id = getResources()
                    .getIdentifier("com.example.my3pu.weatherforecast:drawable/" + getImage(icon), null, null);
            imageview.setImageResource(id);

            String summary = jcurrently.getString("summary");
            TextView summary_detail = (TextView)findViewById(R.id.summary);
            summary_detail.setText(summary + " in " + MainActivity.city + "," + MainActivity.state);

            String mintemp = jdata.getJSONObject(0).getString("temperatureMin");
            String maxtemp = jdata.getJSONObject(0).getString("temperatureMax");
            String highNLow = "L:"+Math.round(Float.parseFloat(mintemp)) +"°|H:"+Math.round(Float.parseFloat(maxtemp))+"°";
            Log.i("low and high", highNLow);
            TextView highLow = (TextView)findViewById(R.id.lowhigh);
            highLow.setText(highNLow);


            Double temperature = Math.floor(Double.parseDouble(jcurrently.getString("temperature")));
            TextView temp = (TextView)findViewById(R.id.temperature);

            temp.setTextSize(50);

            temp.setText(temperature.intValue()+"\u00b0" + MainActivity.deg);

            String precip = jcurrently.getString("precipIntensity");
            Double precipValue = Double.parseDouble(precip);

            if(MainActivity.deg.equals("C"))
                precipValue = 0.0393701*precipValue;

            if(precipValue < 0.002 ) {
                precip = "None";
            }
            else if(precipValue < 0.017)
                precip = "Very Light";
            else if(precipValue < 0.1 )
                precip = "Light";
            else if(precipValue < 0.4 )
                precip = "Moderate";
            else
                precip = "Heavy";

            TextView precipitation = (TextView)findViewById(R.id.precip_value);
            precipitation.setText(precip);

            Double chanceOfRain = Double.parseDouble(jcurrently.getString("precipProbability"))*100;
            TextView cor = (TextView)findViewById(R.id.cor_value);
            cor.setText(chanceOfRain.toString()+" %");

            String windSpeed = String.format("%.2f", Double.parseDouble(jcurrently.getString("windSpeed")));



            Log.i("windspeed",windSpeed);
            TextView WS = (TextView)findViewById(R.id.windSpeed_value);
            String ws_val = MainActivity.deg.equals("C")?"m/s":"mph";
            WS.setText(windSpeed+" "+ws_val);


            String dewPoint = String.format("%.2f", Double.parseDouble(jcurrently.getString("dewPoint")));
            TextView DP = (TextView)findViewById(R.id.dewpoint_value);
            DP.setText(dewPoint+"°"+MainActivity.deg);

            Double humidity = Double.parseDouble(jcurrently.getString("humidity"))*100;
            TextView humidity_value = (TextView)findViewById(R.id.humidity_value);
            humidity_value.setText(humidity.toString() + " %");


            String visibilityVal = String.format("%.2f",Double.parseDouble(jcurrently.getString("visibility")));
            TextView visibleText = (TextView)findViewById(R.id.visibility_value);
            String vis_val = MainActivity.deg.equals("C")?"km":"mi";
            visibleText.setText(visibilityVal+" "+vis_val);


            String sunrise;
            sunrise =  jdata.getJSONObject(0).getString("sunriseTime");
            TextView sunriseView = (TextView)findViewById(R.id.sunrise_time);
            sunriseView.setText(getTimeZone(sunrise));

            String sunset;
            sunset =  jdata.getJSONObject(0).getString("sunsetTime");;
            TextView sunsetView = (TextView)findViewById(R.id.sunset_value);
            sunsetView.setText(getTimeZone(sunset));

        } catch (JSONException e) {
            e.printStackTrace();
        }

        findViewById(R.id.button5).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(ResultActivity.this, MapActivity.class);
                startActivity(intent);

            }
        });

        ImageView fb = (ImageView)findViewById(R.id.fb);
        fb.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                try {
                    Log.i("FB check", jcurrently.getString("summary"));
                } catch (JSONException e) {
                    e.printStackTrace();
                }


                String title = "Current Weather in " + MainActivity.city + "," + MainActivity.state;
                String desc = null;
                try {
                    String temp_fb = jcurrently.getString("temperature");
                    int temp_int = Math.round(Float.parseFloat(temp_fb));
                    desc = jcurrently.getString("summary") + "," + temp_int + "°" + MainActivity.deg;
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                String img = null;
                try {
                    img = "http://cs-server.usc.edu:45678/hw/hw8/images/" + getImage(jcurrently.getString("icon")) + ".png";
                    Log.i("image", img);

                } catch (JSONException e) {
                    e.printStackTrace();
                }

                FacebookSdk.sdkInitialize(getApplicationContext());
                callbackManager = CallbackManager.Factory.create();
                shareDialog = new ShareDialog(ResultActivity.this);
                // this part is optional
                shareDialog.registerCallback(callbackManager, new FacebookCallback<Sharer.Result>() {
                    public void onSuccess(Sharer.Result result) {

                        if (result.getPostId() == null)
                            Toast.makeText(getApplicationContext(), "Post was not published", Toast.LENGTH_SHORT).show();
                        else
                            Toast.makeText(getApplicationContext(), "Post published successfully", Toast.LENGTH_SHORT).show();

                    }

                    @Override
                    public void onCancel() {
                        Toast.makeText(getApplicationContext(), "Post was cancelled", Toast.LENGTH_SHORT).show();
                    }

                    @Override
                    public void onError(FacebookException error) {
                        Toast.makeText(getApplicationContext(), "Error posting data", Toast.LENGTH_SHORT).show();
                    }

                });


                if (ShareDialog.canShow(ShareLinkContent.class)) {
                    ShareLinkContent linkContent = null;


                    linkContent = new ShareLinkContent.Builder()

                            .setContentTitle(title)
                            .setContentDescription(desc)
                            .setContentUrl(Uri.parse("http://forecast.io"))
                            .setImageUrl(Uri.parse(img))
                            .build();


                    shareDialog.show(linkContent);
                }
            }
        });


    }

    @Override
    protected void onActivityResult(final int requestCode, final int resultCode, final Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        callbackManager.onActivityResult(requestCode, resultCode, data);
    }

    public static String getImage(String icon) {
      String image;
        switch(icon){
            case "clear-day": image = "clear";
                break;
            case "clear-night": image = "clear_night";
                break;
            case "rain": image = "rain";
                break;
            case "snow": image = "snow";
                break;
            case "sleet": image = "sleet";
                break;
            case "wind": image ="wind";
                break;
            case "fog": image ="fog";
                break;
            case "cloudy": image = "cloudy";
                break;
            case "partly-cloudy-day":image = "cloud_day";
                break;
            case "partly-cloudy-night": image = "cloud_night";
                break;
            default: image ="wind";
                break;
        }

    return image;
    }



    public static String getTimeZone(String time) throws JSONException {
        long converted_time = (Long.parseLong(time) * 1000L);
        Date date = new Date(converted_time);

        SimpleDateFormat format = new SimpleDateFormat("h:mm a");
        format.setTimeZone(TimeZone.getTimeZone(json_data.getString("timezone")));
        return format.format(date);
    }

    public static String getTimeZone_day(String time) throws JSONException {
        long converted_time = (Long.parseLong(time) * 1000L);
        Date date = new Date(converted_time);

        SimpleDateFormat day = new SimpleDateFormat("EEEE");

       return day.format(date);
    }
    public static String getTimeZone_month(String time) throws JSONException {
        long converted_time = (Long.parseLong(time) * 1000L);
        Date date = new Date(converted_time);

        SimpleDateFormat month = new SimpleDateFormat("MMM");

        return month.format(date);
    }

    public static String getTimeZone_date(String time) throws JSONException {
        long converted_time = (Long.parseLong(time) * 1000L);
        Date date = new Date(converted_time);

        SimpleDateFormat month = new SimpleDateFormat("dd");

        return month.format(date);
    }

    public void fbShare(View view) throws JSONException {
        Log.i("Inside onclick",MainActivity.state);
    }






    public void getMoreDetails(View view) {
        Intent intent = new Intent(this, DetailsActivity.class);
        try {
            Log.i("check",json_data.getString("latitude"));
        } catch (JSONException e) {
            e.printStackTrace();
        }
        intent.putExtra("JSONData", json_data.toString());
        startActivity(intent);
    }

    @Override
    public void onClick(View v) {

    }
}
