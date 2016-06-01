package com.example.my3pu.weatherforecast;

import android.content.Intent;

import java.io.BufferedInputStream;
import java.net.Socket;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.text.method.HideReturnsTransformationMethod;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;


public class MainActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener{
    EditText ev_address,ev_city;
    TextView street_error,city_error;
    Spinner ev_state;
    static String radiovalue;
    static String deg = "F";
    RadioButton degF;
    RadioButton degC;


    public static URL url;

    String address = null;
    static String city = null;
    static String state = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Spinner spinner = (Spinner) findViewById(R.id.spinner);
        ArrayAdapter adapter = ArrayAdapter.createFromResource(this, R.array.states_list, R.layout.support_simple_spinner_dropdown_item);

        spinner.setAdapter(adapter);
        spinner.setOnItemSelectedListener(this);


        ImageView link = (ImageView) findViewById(R.id.imageView1);
        link.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                startActivity(new Intent(Intent.ACTION_VIEW, Uri.parse("http://forecast.io")));
            }
        });

        findViewById(R.id.button).setOnClickListener(new View.OnClickListener() {
                                                         @Override
                                                         public void onClick(View v) {

                                                             ev_address = (EditText) findViewById(R.id.street);
                                                             address = ev_address.getText().toString();

                                                             ev_city = (EditText) findViewById(R.id.city);
                                                             city = ev_city.getText().toString();

                                                             ev_state = (Spinner) findViewById(R.id.spinner);
                                                             state = ev_state.getSelectedItem().toString();

                                                             RadioGroup rg_view = (RadioGroup) findViewById(R.id.rg);
                                                             degF = (RadioButton)findViewById(R.id.radioButton2);
                                                             degC = (RadioButton)findViewById(R.id.radioButton);
                                                             radiovalue = ((RadioButton) findViewById(rg_view.getCheckedRadioButtonId())).getText().toString();

                                                             if (radiovalue.equals("Celsius"))
                                                                 deg = "C";

                                                             Log.i("Deg", radiovalue);

                                                             if ((ev_address.getText().toString().length() <= 0) || (ev_city.getText().toString().length() <= 0) || (state.length() <= 0) || state.equals("Select")) {

                                                                 if (state.length() <= 0 || state.equals("Select")) {
                                                                     street_error = (TextView) findViewById(R.id.textView10);
                                                                     System.out.println("state empty");
                                                                     street_error.setText("Please enter state");

                                                                 }
                                                                 if ((ev_city.getText().toString().length() <= 0)) {
                                                                     street_error = (TextView) findViewById(R.id.textView10);
                                                                     System.out.println("City empty");
                                                                     street_error.setText("Please enter city address");

                                                                 }
                                                                 if ((ev_address.getText().toString().length() <= 0)) {
                                                                     street_error = (TextView) findViewById(R.id.textView10);
                                                                     System.out.println("Street empty");
                                                                     street_error.setText("Please enter street address");
                                                                 }


                                                             } else {
                                                                 try {//http://forecasthw6-env.elasticbeanstalk.com/forecastValidate.php?address=678+wall+st&city=new+york&state=NY&degree=Fahrenheit
                                                                     String phpurl = "http://forecasthw6-env.elasticbeanstalk.com/forecastValidate.php?address=" + Uri.encode(address) + "&city=" + Uri.encode(city) + "&state=" + Uri.encode(state) + "&degree=" + radiovalue;
                                                                     //phpurl= URLEncoder.encode(phpurl, "UTF-8");
                                                                     Log.i("URL", phpurl);
                                                                     url = new URL(phpurl);

                                                                 } catch (Exception e) {
                                                                     // TODO Auto-generated catch block
                                                                     e.printStackTrace();
                                                                 }

                                                                 HttpTask httpTask = new HttpTask();
                                                                 httpTask.execute(url);
                                                             }

                                                         }


                                                     }
        );

        findViewById(R.id.button3).setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {

                    Intent intent = new Intent(MainActivity.this,DisplayDetails.class);
                    startActivity(intent);


            }



        });
    }

    public class HttpTask extends AsyncTask<URL, Integer, String> {


        protected String doInBackground(URL... params) {
            HttpURLConnection connection = null;
            try {


                //URL url= new URL("http://forecasthw6-env.elasticbeanstalk.com/forecastValidate.php?address=678+wall+st&amp;city=new+york&amp;state=NY&amp;degree=Fahrenheit");
                connection = (HttpURLConnection)MainActivity.url.openConnection();
            } catch (IOException e1) {
                // TODO Auto-generated catch block
                e1.printStackTrace();
            }

            InputStreamReader inputstream = null;
            try {
                inputstream = new InputStreamReader(new BufferedInputStream(connection.getInputStream()));
            } catch (IOException e) {
                e.printStackTrace();
            }
            assert inputstream != null;
            final BufferedReader in = new BufferedReader(inputstream);
            StringBuffer buf = new StringBuffer();
            int i;
            try {
                while((i = in.read()) != -1){
                    buf.append((char) i);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }

            String data = buf.toString();
            return data;

        }
        protected void onPostExecute(String result) {

            Intent intent = new Intent(MainActivity.this, ResultActivity.class);
            intent.putExtra("JSONData", result);
            startActivity(intent);

        }

    }
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        TextView textView = (TextView) view;
        if((textView.getText()=="Select")||(textView.getText()==""))
            Toast.makeText(this,"You selected"+textView.getText(),Toast.LENGTH_SHORT).show();
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }



    public void clear(View view){
        EditText address = (EditText)findViewById(R.id.street);
        address.setText("");
        EditText city = (EditText)findViewById(R.id.city);
        city.setText("");
        degF = (RadioButton)findViewById(R.id.radioButton2);
        degF.setChecked(true);
        Spinner ev_state = (Spinner)findViewById(R.id.spinner);
        ev_state.setSelection(0,false);
        TextView error_text = (TextView)findViewById(R.id.textView10);
        error_text.setText("");
    }

}
