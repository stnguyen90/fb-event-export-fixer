<!DOCTYPE html>
<html>
    <head>
        <title>FB Event Export Fixer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
    </head>
    <body>
        <div class="container">
            <h1>FB Event Export Fixer</h1>
            <hr>
            <p>Facebook has a nice feature of being able to export your upcoming events, but there aren't any options when exporting. This app helps solve that issue in 3 easy steps.</p>
            <ol>
                <li>Copy and paste the Facebook Event Export URL into the FB Events URL input below</li>
                <li>Select from the various export options</li>
                <li>Import the calendar using the new iCal URL</li>
            </ol>
            <form class="form-horizontal">
                <fieldset>
                    <!-- Form Name -->
                    <legend>iCal URL Generator</legend>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="url">FB Events URL</label>
                        <div class="controls">
                            <input id="url" name="url" type="text" placeholder="http://www.facebook.com/ical/u.php?uid=xxxxxxxx&amp;key=xxxxxxxxxx" class="input-xxlarge" required="">
                            <p class="help-block">The export URL on your FB <a href="https://www.facebook.com/events/calendar" target="_blank">Events page</a> </p>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="uid">UID</label>
                        <div class="controls">
                            <input id="uid" name="uid" type="text" placeholder="" class="input-xlarge">
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="key">Key</label>
                        <div class="controls">
                            <input id="key" name="key" type="text" placeholder="" class="input-xlarge">
                        </div>
                    </div>

                    <!-- Multiple Checkboxes (inline) -->
                    <div class="control-group">
                        <label class="control-label" for="checkboxes">Include Events with Response of</label>
                        <div class="controls">
                            <label class="checkbox inline" for="checkboxes-going">
                                <input type="checkbox" class="includes" name="includes[]" id="checkboxes-going" checked="" value="g">
                                Going
                            </label>
                            <label class="checkbox inline" for="checkboxes-maybe">
                                <input type="checkbox" class="includes" name="includes[]" id="checkboxes-maybe" checked="" value="m">
                                Maybe
                            </label>
                            <label class="checkbox inline" for="checkboxes-awaitingreply">
                                <input type="checkbox" class="includes" name="includes[]" id="checkboxes-awaitingreply" checked="" value="ar">
                                Awaiting Reply
                            </label>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="control-group">
                        <label class="control-label" for="iCalURL">New iCal URL</label>
                        <div class="controls">
                            <input id="iCalURL" name="iCalURL" type="text" placeholder="" class="input-xlarge">
                            <a id="copy" name="copy" class="btn" data-clipboard-target="iCalURL" disabled="">Copy</a>
                            <a id="addToGCal" name="addToGCal" class="btn" disabled="" target="_blank">Add to Google Calendar</a>
                            <p class="help-block">Copy and paste this as your iCal URL or click the button to import to Google Calendar.</p>
                        </div>
                    </div>

                </fieldset>
            </form>
            <hr>
            <h2>FAQ</h2>
            <div class="accordion" id="accordion2">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                            Can I selectively choose which events to export?
                        </a>
                    </div>
                    <div id="collapseOne" class="accordion-body collapse">
                        <div class="accordion-inner">
                            This app is designed to be set up once and then automatically pull new events as they come from FB. Therefore, it doesn't make sense to let you select events, because once those events pass, they'll be gone
and the calendar will display nothing.
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
                            Is my data safe?
                        </a>
                    </div>
                    <div id="collapseTwo" class="accordion-body collapse">
                        <div class="accordion-inner">
                            Your data is absolutely safe. We only filter the data from Facebook and send it through. Nothing is saved on our servers.
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
                            How do I get the FB Events URL?
                        </a>
                    </div>
                    <div id="collapseThree" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <img src="assets/img/fb_event_export_blurred.png">
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
                            How do I use the iCal URL in Google Calendar?
                        </a>
                    </div>
                    <div id="collapseFour" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <img src="assets/img/google_calendar_cropped.png">
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFive">
                            Who do I contact if I have questions, comments, feature requests, or bug reports?
                        </a>
                    </div>
                    <div id="collapseFive" class="accordion-body collapse">
                        <div class="accordion-inner">
                            You can email me at stnguyen90@g33kdev.com
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="http://code.jquery.com/jquery.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/ZeroClipboard.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function()
            {
                // update the UID and Key inputs when the url input is changed
                $("#url").on('keyup', function()
                {
                    var url = $(this).val();
                    var query = url.split("?")[1];
                    for (var pairIdx in query.split("&") )
                    {
                        var pairArray = query.split("&")[pairIdx].split("=");
                        if ( pairArray[0] == 'uid' )
                        {
                            $("#uid").val(pairArray[1]);
                            $("#uid").parents('.control-group').addClass('info');
                        }
                        else if ( pairArray[0] == 'key' )
                        {
                            $("#key").val(pairArray[1]);
                            $("#key").parents('.control-group').addClass('info');
                        }
                    }

                    $("#key, #uid").trigger('change');
                });

                // update the iCalURL button when the UID, Key inputs or Include checkboxes are changed
                $("#key, #uid, .includes").on('change', function()
                {
                    var uid = $("#uid").val();
                    var key = $("#key").val();
                    var includes = $(".includes:checked");
                    var url = window.location.href + 'parse.php?uid=' + uid + '&key=' + key;
                    includes.each(function(i, elem)
                    {
                        url += '&includes[]=' + includes.eq(i).val();
                    });
                    $("#iCalURL").val(url);
                    $("#addToGCal").attr('href', 'http://www.google.com/calendar/render?cid=' + encodeURIComponent(url));
                    $("#iCalURL").siblings('.btn').removeAttr('disabled');
                    $("#iCalURL").parents('.control-group').addClass('success');
                });

                // initialize the Copy button
                var clip = new ZeroClipboard($("#copy"), { moviePath: "assets/img/ZeroClipboard.swf" });
                clip.on( 'complete', function(client, args)
                {
                    pop.popover('show');
                    setTimeout(function(){pop.popover('hide');}, 1500);
                } );

                // initialize the copy button popover
                var content = 'The URL has been copied to your clipboard!';
                var options = { 'content' : content, 'placement' : 'right', 'delay' : { 'show' : 0, 'hide' : 100 } };
                var pop = $("#copy").popover(options);
            });
        </script>
    </body>
</html>