(function (Drupal, once, drupalSettings) {
    "use strict";
    Drupal.behaviors.APIzimbraAgendaBehavior = {
      attach: function (context, settings) {
        // Load on front page only,
        if (drupalSettings.path.isFront && drupalSettings.api_zimbra_pleiade.field_zimbra_agenda ) {
      //if (drupalSettings.path.isFront && drupalSettings.api_zimbra_pleiade.field_zimbra_agenda && drupalSettings.api_zimbra_pleiade.field_zimbra_for_demo ) { Mode Démo
          once("APIzimbraAgendaBehavior", "#zimbra_block_agenda_id", context).forEach(
            
            function () {
                    // spinner
                    document.getElementById("zimbra_block_agenda_id").innerHTML = drupalSettings.api_lemon_pleiade.spinner;
                    // requete
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", Drupal.url("v1/api_zimbra_pleiade/zimbra_tasks_query"));
                    xhr.responseType = "json";

                    xhr.onload = function () {
                        if (xhr.status === 200) {
                            var donnees = xhr.response;
                            // console.log(donnees.appt);

                            if(donnees){
                              var event_array = [];
                              document.cookie = "nbOfTasks=" + donnees.appt.length;
                              for (var i = 0; i < donnees.appt.length; i++) {
                                  var end_task = donnees.appt[i].inv[0].comp[0].e[0].u /1000;
                                  var start_task = donnees.appt[i].inv[0].comp[0].s[0].u /1000;
                                  var endDate = new Date( end_task * 1000 + 3600*1000);
                                  var startDate = new Date( start_task * 1000 + 3600*1000 );
                                  
                                  event_array[i] = {
                                      title: donnees.appt[i].inv[0].comp[0].name, // titre court
                                      start: startDate.toISOString().replace('.000Z', ''),
                                      end: endDate.toISOString().replace('.000Z', ''),
                                      
                                      extendedProps: { // titre long avec du html pour te faire plaiz ;)
                                          longTitle: '<b>'+donnees.appt[i].inv[0].comp[0].name + '</b>, <br><strong>Lieu : </strong>'+ donnees.appt[i].inv[0].comp[0].loc
                                        }
                                  }                              
                              } 
                               // debug
                               // console.log(event_array);
                                  var calendarEl = document.getElementById("zimbra_block_agenda_id");
                                  var currentDateObj = new Date();
                                  
                                  var numberOfMlSeconds = currentDateObj.getTime();
                                 
                                  var addMlSeconds = 60 * 60 * 1000 *2;
                                  var newDateObj = new Date(numberOfMlSeconds + addMlSeconds);
                                  console.log(newDateObj)
                                  var calendar = new FullCalendar.Calendar(calendarEl, {
                                      timeZone: "UTC",
                                      locale: "fr",
                                      headerToolbar: {
                                        start: 'title', // will normally be on the left. if RTL, will be on the right
                                        today: false,
                                        end: false,
                                      },
                                      nowIndicator: true,
                                      now: newDateObj,
                                     
                                      initialView: "timeGridDay",
                                      slotMinTime: "07:00:00",
                                      slotMaxTime: "19:00:00",
                                      themeSystem: "bootstrap",
                                      slotLabelInterval: "01:00:00",
                                      events: event_array
                                  });
                                  calendar.render();
                                  
                              }
                            }
                            
                    };
                    xhr.onerror = function () {
                    console.log("Error making AJAX call");
                    };
                    xhr.onabort = function () {
                    console.log("AJAX call aborted");
                    };
                    xhr.ontimeout = function () {
                    console.log("AJAX call timed out");
                    };
                    xhr.onloadend = function () {

                    
                      
                    // feather icons
                    feather.replace();
                    };

                    xhr.send();

                    
                }); // fin once function
            }
          },
        };
      })(Drupal, once, drupalSettings);