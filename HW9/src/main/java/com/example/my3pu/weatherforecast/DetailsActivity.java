package com.example.my3pu.weatherforecast;

import android.app.Activity;
import android.graphics.Color;
import android.graphics.Typeface;
import android.os.Bundle;
import android.support.design.widget.TabLayout;
import android.util.Log;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.AbsListView;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.w3c.dom.Text;

public class DetailsActivity extends Activity {
    JSONArray jdata = null;
    JSONObject jresponse = null;
    JSONObject jcurrently = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details);

        Bundle bundle = getIntent().getExtras();
        final String JSON_data = bundle.getString("JSONData");


        String summary = "More details for " + MainActivity.city + "," + MainActivity.state;
        try {
            jresponse = new JSONObject(JSON_data);
        } catch (JSONException e) {
            e.printStackTrace();
        }


        TextView sum = (TextView) findViewById(R.id.textView12);
        sum.setText(summary);
        getNext24Hours(getCurrentFocus());
    }

    public void getNext24Hours(View view) {

        Button next24 = (Button)findViewById(R.id.button6);
        next24.setBackgroundColor(Color.parseColor("#4A80B2"));

        Button next7 = (Button)findViewById(R.id.button7);
        next7.setBackgroundColor(Color.parseColor("#A9B7BF"));



        TableLayout tableLayout1 = (TableLayout) findViewById(R.id.table1);
        tableLayout1.removeAllViews();
        tableLayout1.setVisibility(View.VISIBLE);


        TableLayout tableLayout2 = (TableLayout) findViewById(R.id.table2);
        tableLayout2 = (TableLayout) findViewById(R.id.table2);
        tableLayout2.setVisibility(View.INVISIBLE);

        String timeVal = null;
        String icon = null;
        String temp = null;

        JSONObject jhourly = null;
        try {
            jhourly = jresponse.getJSONObject("hourly");
            jcurrently = jresponse.getJSONObject("currently");
        } catch (JSONException e) {
            e.printStackTrace();
        }

        try {
            jdata = jhourly.getJSONArray("data");

        } catch (JSONException e) {
            e.printStackTrace();
        }
        int N = 24;

        TableLayout tableLayout = null;
        TableRow row = null;
        TableRow.LayoutParams tableRowParams = null;

        TextView col1 = new TextView(this);
        col1.setPadding(10, 10, 10, 10);
        col1.setTextSize(18);

        col1.setTypeface(null, Typeface.BOLD);

        TextView icon1 = new TextView(this);
        icon1.setPadding(10, 10, 10, 10);
        icon1.setTextSize(18);
        icon1.setTypeface(null, Typeface.BOLD);

        TextView temp1 = new TextView(this);
        temp1.setPadding(10, 10, 10, 10);
        temp1.setTextSize(18);

        temp1.setTypeface(null, Typeface.BOLD);

        col1.setText("Time");
        icon1.setText("Summary");
        temp1.setText("Temp(°" + MainActivity.deg + ")");

        tableLayout = (TableLayout) findViewById(R.id.table1);
        TableRow firstrow = new TableRow(getApplicationContext());

        firstrow.setBackgroundColor(Color.parseColor("#84ece6"));


        firstrow.addView(col1);
        firstrow.addView(icon1);
        firstrow.addView(temp1);

        TableRow.LayoutParams col1params = (TableRow.LayoutParams) col1.getLayoutParams();
        col1params.gravity = Gravity.LEFT;
        temp1.setLayoutParams(col1params);

        TableRow.LayoutParams icon1params = (TableRow.LayoutParams) icon1.getLayoutParams();
        icon1params.gravity = Gravity.LEFT;
        temp1.setLayoutParams(icon1params);

        TableRow.LayoutParams temp1params = (TableRow.LayoutParams) temp1.getLayoutParams();
        temp1params.gravity = Gravity.RIGHT;
        temp1.setLayoutParams(temp1params);

        col1.setPadding(10, 10, 10, 10);
        icon1.setPadding(10, 10, 10, 10);
        temp1.setPadding(10, 10, 10, 10);
        tableLayout.addView(firstrow);


        for (int i = 0; i < 24; i++) {

            try {
                timeVal = jdata.getJSONObject(i).getString("time");
            } catch (JSONException e) {
                e.printStackTrace();
            }

            try {
                icon = jdata.getJSONObject(i).getString("icon");
            } catch (JSONException e) {
                e.printStackTrace();
            }
            // create a new textview
            final TextView rowTextView = new TextView(this);
            rowTextView.setTextSize(18);
            rowTextView.setTextColor(Color.BLACK);
            rowTextView.setPadding(10, 10, 10, 10);
            final ImageView image_view = new ImageView(this);
            image_view.setPadding(10, 10, 10, 10);

            final TextView tempView = new TextView(this);
            tempView.setTextSize(18);
            tempView.setPadding(10, 10, 10, 10);
            // set some properties of rowTextView or something
            try {


                rowTextView.setText(ResultActivity.getTimeZone(timeVal));

                int id = getResources()
                        .getIdentifier("com.example.my3pu.weatherforecast:drawable/" + ResultActivity.getImage(icon), null, null);

                image_view.setImageResource(id);
                String temperature = jdata.getJSONObject(i).getString("temperature");
                Log.i("temperature string", temperature);
                int temp_float = Math.round(Float.parseFloat(temperature));
//
                tempView.setText(String.valueOf(temp_float));
            } catch (JSONException e) {
                e.printStackTrace();
            }

            // add the textview to the linearlayout

            tableLayout = (TableLayout) findViewById(R.id.table1);
            row = new TableRow(getApplicationContext());
            tableRowParams = new TableRow.LayoutParams(TableRow.LayoutParams.WRAP_CONTENT, TableRow.LayoutParams.WRAP_CONTENT);

//            tableRowParams.setMargins(1, 1, 1, 1);
//            tableRowParams.weight = 1;
            tableRowParams.height = 100;
            tableRowParams.width = 100;

            if ((i % 2) == 0)
                row.setBackgroundColor(0xffcccccc);




            row.addView(rowTextView);
            row.addView(image_view);
            row.addView(tempView);

            TableRow.LayoutParams rowTextView_param = (TableRow.LayoutParams) rowTextView.getLayoutParams();
            rowTextView_param.gravity = Gravity.LEFT;
            rowTextView_param.width = 200;
            rowTextView_param.height = 200;
            rowTextView.setLayoutParams(rowTextView_param);

            TableRow.LayoutParams image_view_param = (TableRow.LayoutParams) image_view.getLayoutParams();
            image_view_param.gravity = Gravity.CENTER;
            image_view_param.height = 200;
            image_view_param.width = 200;
            image_view.setLayoutParams(image_view_param);

            TableRow.LayoutParams tempView_param = (TableRow.LayoutParams) tempView.getLayoutParams();
            tempView_param.gravity = Gravity.RIGHT;
            tempView_param.height = 200;
            tempView_param.width = 200;
            tempView.setLayoutParams(tempView_param);


            tableLayout.addView(row);


            // save a reference to the textview for later

        }

        final TableRow lastrow = new TableRow(getApplicationContext());
        TextView t1 = new TextView(this);
        TextView t2 = new TextView(this);


        final TextView myButton = new TextView(this);
        myButton.setText("+");
        myButton.setTextSize(30);

        lastrow.addView(t1);
        lastrow.addView(myButton);
        lastrow.addView(t2);

        TableRow.LayoutParams plus = (TableRow.LayoutParams) myButton.getLayoutParams();
        plus.gravity = Gravity.CENTER;
        plus.width = 200;
        plus.height = 200;
        myButton.setLayoutParams(plus);

        TableRow.LayoutParams t1_param = (TableRow.LayoutParams) t1.getLayoutParams();
        t1_param.width = 200;
        t1_param.height = 200;
        t1.setLayoutParams(t1_param);

        TableRow.LayoutParams t2_param = (TableRow.LayoutParams) t2.getLayoutParams();
        t2_param.width = 200;
        t2_param.height = 200;
        t2.setLayoutParams(t2_param);

        //tableRowParams.span = 3;
        //Last image is screwed

        final TableLayout finalTableLayout = tableLayout;
        myButton.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                finalTableLayout.removeView(lastrow);
                myButton.setBackgroundColor(Color.BLACK);
                display_all();
            }

            private void display_all() {

                int N = 48;


                String icon = null;
                String temp = null;
                String timeVal = null;

                TableLayout tableLayout = null;
                TableRow row = null;
                TableRow.LayoutParams tableRowParams = null;

                for (int i = 24; i < 48; i++) {

                    try {
                        timeVal = jdata.getJSONObject(i).getString("time");
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    try {
                        icon = jdata.getJSONObject(i).getString("icon");
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                    // create a new textview
                    final TextView rowTextView = new TextView(getApplicationContext());
                    rowTextView.setTextSize(18);

                    rowTextView.setPadding(10, 10, 10, 10);
                    final ImageView image_view = new ImageView(getApplicationContext());
                    image_view.setAdjustViewBounds(true);
                    image_view.setPadding(10, 10, 10, 10);

                    final TextView tempView = new TextView(getApplicationContext());
                    tempView.setTextSize(18);
                    tempView.setPadding(10, 10, 10, 10);
                    // set some properties of rowTextView or something
                    rowTextView.setTextColor(Color.BLACK);
                    tempView.setTextColor(Color.BLACK);
                    try {


                        rowTextView.setText(ResultActivity.getTimeZone(timeVal));

                        int id = getResources()
                                .getIdentifier("com.example.my3pu.weatherforecast:drawable/" + ResultActivity.getImage(icon), null, null);

                        image_view.setImageResource(id);
                        String temperature = jdata.getJSONObject(i).getString("temperature");

                        int temp_float = Math.round(Float.parseFloat(temperature));
                        tempView.setText(String.valueOf(temp_float));

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    // add the textview to the linearlayout

                    tableLayout = (TableLayout) findViewById(R.id.table1);
                    row = new TableRow(getApplicationContext());
                    tableRowParams = new TableRow.LayoutParams(TableRow.LayoutParams.WRAP_CONTENT, TableRow.LayoutParams.WRAP_CONTENT);

                    tableRowParams.setMargins(1, 1, 1, 1);
                    tableRowParams.weight = 1;
                    tableRowParams.height = 100;
                    tableRowParams.width = 100;

                    if ((i % 2) == 0)
                        row.setBackgroundColor(0xffcccccc);

                    rowTextView.setTextColor(Color.BLACK);
                    tempView.setTextColor(Color.BLACK);
                    row.addView(rowTextView);
                    row.addView(image_view);
                    row.addView(tempView);

                    TableRow.LayoutParams rowTextView_param = (TableRow.LayoutParams) rowTextView.getLayoutParams();
                    rowTextView_param.gravity = Gravity.LEFT;
                    rowTextView_param.height = 200;
                    rowTextView_param.width = 200;
                    rowTextView.setLayoutParams(rowTextView_param);

                    TableRow.LayoutParams image_view_param = (TableRow.LayoutParams) image_view.getLayoutParams();
                    image_view_param.gravity = Gravity.CENTER;
                    image_view_param.height = 200;
                    image_view_param.width = 200;
                    image_view.setLayoutParams(image_view_param);

                    TableRow.LayoutParams tempView_param = (TableRow.LayoutParams) tempView.getLayoutParams();
                    tempView_param.gravity = Gravity.RIGHT;
                    tempView_param.height = 200;
                    tempView_param.width = 200;
                    tempView.setLayoutParams(tempView_param);

                    tableLayout.addView(row);


                    // save a reference to the textview for later

                }
            }


        });
        lastrow.setBackgroundColor(0xffcccccc);
        //lastrow.addView(myButton, tableRowParams);
        tableLayout.addView(lastrow);

    }

    public void getNext7days(View view) throws JSONException {
        TableLayout tableLayout1 = (TableLayout) findViewById(R.id.table1);
        tableLayout1.setVisibility(View.INVISIBLE);


        TableLayout tableLayout2 = (TableLayout) findViewById(R.id.table2);
        tableLayout2 = (TableLayout) findViewById(R.id.table2);
        tableLayout2.removeAllViews();
        tableLayout2.setVisibility(View.VISIBLE);

        Button next7 = (Button)findViewById(R.id.button7);
        next7.setBackgroundColor(Color.parseColor("#4A80B2"));

        Button next24 = (Button)findViewById(R.id.button6);
        next24.setBackgroundColor(Color.parseColor("#A9B7BF"));




        try {
            JSONObject jdaily = jresponse.getJSONObject("daily");
            jdata = jdaily.getJSONArray("data");
        } catch (JSONException e) {
            e.printStackTrace();
        }
        int i;
        for (i = 1; i < 8; i++) {

            TableRow row_one = new TableRow(getApplicationContext());
            TableRow row_two = new TableRow(getApplicationContext());

            final TextView day_one = new TextView(this);
            day_one.setTextSize(21);
            day_one.setTypeface(null, Typeface.BOLD);
                day_one.setText(ResultActivity.getTimeZone_day(jdata.getJSONObject(i).getString("sunriseTime")) + "," +
                        ResultActivity.getTimeZone_month(jdata.getJSONObject(i).getString("sunriseTime")) + " " +
                        ResultActivity.getTimeZone_date(jdata.getJSONObject(i).getString("sunriseTime")));


            final TextView day_two = new TextView(this);
            day_two.setTypeface(null, Typeface.BOLD);
            day_two.setTextSize(21);

            String minTemp = jdata.getJSONObject(i).getString("temperatureMin");
            String maxTemp = jdata.getJSONObject(i).getString("temperatureMax");


            day_two.setText("Min: " + Math.round(Float.parseFloat(minTemp)) + "°" +MainActivity.deg+"| Max: " + Math.round(Float.parseFloat(maxTemp))  + "°"+MainActivity.deg);
            String check = "Min: " + jdata.getJSONObject(i).getString("temperatureMin") + "°" +MainActivity.deg+ "|Max: " + jdata.getJSONObject(i).getString("temperatureMax") + "°"+MainActivity.deg;
            Log.i("check", check);




            final ImageView image_view = new ImageView(this);
            int id = getResources()
                    .getIdentifier("com.example.my3pu.weatherforecast:drawable/" + ResultActivity.getImage(jdata.getJSONObject(i).getString("icon")), null, null);

            image_view.setImageResource(id);
            image_view.setAdjustViewBounds(true);
            image_view.setMaxHeight(200);
            image_view.setMaxWidth(200);
            image_view.setPadding(10, 5, 5, 0);


            TableRow.LayoutParams tableRowParams_seven = new TableRow.LayoutParams(TableRow.LayoutParams.MATCH_PARENT, TableRow.LayoutParams.MATCH_PARENT);
            tableRowParams_seven.setMargins(1, 1, 1, 1);
            tableRowParams_seven.weight = 1;
            tableRowParams_seven.height = 50;
            tableRowParams_seven.width = 50;

            tableRowParams_seven.setMargins(10,10,10,10);

            row_one.addView(day_one);
            row_one.addView(image_view);
            row_two.addView(day_two);

            TableRow.LayoutParams day_one_param = (TableRow.LayoutParams) day_one.getLayoutParams();

            day_one_param.height = 200;
            day_one_param.width = 200;
            day_one_param.gravity = Gravity.BOTTOM;
            day_one.setLayoutParams(day_one_param);

            TableRow.LayoutParams day_two_param = (TableRow.LayoutParams) day_two.getLayoutParams();

            day_two_param.gravity = Gravity.TOP;

            day_two.setLayoutParams(day_two_param);

            TableRow.LayoutParams image_view_param = (TableRow.LayoutParams) image_view.getLayoutParams();

            image_view_param.height = 200;
            image_view_param.width = 200;
            image_view_param.gravity = Gravity.RIGHT;
            image_view.setLayoutParams(image_view_param);

            String color = null;
            switch (i)
            {
                case 1: color = "#FFDB6A";
                        break;
                case 2: color = "#A0E7FF";
                        break;
                case 3: color = "#FFC4EA";
                        break;
                case 4: color = "#C4FFA5";
                        break;
                case 5: color = "#FFBDB7";
                        break;
                case 6: color = "#EFFFB5";
                        break;
                case 7: color = "#BCBEFF";
                        break;
                default:color = "#BCBEFF";
                        break;

            }
            row_one.setBackgroundColor(Color.parseColor(color));
            row_two.setBackgroundColor(Color.parseColor(color));
            tableLayout2.addView(row_one);
            tableLayout2.addView(row_two);


        }



    }

}

