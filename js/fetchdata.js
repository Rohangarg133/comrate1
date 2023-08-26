var comicdata, trendingdata, specialsdata, videoslist, comments, standup_videos, populardata, moviesdata;

$(document).ready(function () {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            // checking country of user
            fetch('https://ipapi.co/country_name/')
                .then(function (response) {
                    response.text().then(txt => {
                        if (txt != "India") {
                            // $('select>option:eq(3)').prop('selected', true);
                            $('#all_comics_cards_countryfilter').val(3);
                            $('#get_specials_list_countryfilter').val(3);
                            tales_list = tales_eng;
                        }
                    });
                })
                .catch(function (error) {
                });

            // parsing json data and calling their functions
            fulldata = JSON.parse(this.responseText)
            trendingdata = fulldata['trending_list'];
            var downloadingImage = new Image();
            downloadingImage.src = 'https://i3.wp.com/i.ytimg.com/vi/' + trendingdata[trendingdata.length - 1]['videourl'] + `/maxresdefault.jpg`;
            downloadingImage.onload = function(){
                // document.getElementById('trendingytplayerimg').src = this.src;
                trending_list(-1);
              };
            specialsdata = fulldata['comic_special'];
            
            standup_videos = fulldata['comicvideos'];
            
            comicdata = fulldata['comics_list'];
            // populardata = fulldata['popular_list'];
            moviesdata = fulldata['movies']
            completelyloaded++;
            completely_loaded();
        }

    }
    xmlhttp.open("GET", "data.json");
    xmlhttp.send();
});

function fetch_all_data(type, rowno) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (type == 'comics') {
                comicdata[rowno] = JSON.parse(this.responseText);
            }
            else if (type == 'movies')
                moviesdata[rowno] = JSON.parse(this.responseText);
            handleHashChange();
        }
    }
    xmlhttp.open("GET", "/server/database.php?q=" + type + "&rowno=" + rowno, true);
    xmlhttp.send();
}

//-----for yt videos of each comic-----------
function fetch_yt_videos(channel_id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            videoslist = JSON.parse(this.responseText);
            $('#comicmodal').modal('show');
            get_comics_modaldata_ytvideos();
        }
    }
    xmlhttp.open("GET", "/server/yt.php?q=" + channel_id, true);
    xmlhttp.send();
}

function fetch_comments(comicid) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            comments = JSON.parse(this.responseText);
            fill_comments();
            recommend(comicid);
        }
    }
    xmlhttp.open("GET", "/server/database.php?q=" + comicid, true);
    xmlhttp.send();
}