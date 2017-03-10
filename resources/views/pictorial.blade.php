<style>
    .pictorial-row {
        background-color: #d32118;
        margin-bottom: 40px;
    }

    .pictorial-container {
        padding: 20px 0;
        /*width: 90%;*/
        margin: 0 auto;
        height: 350px;

        /*border: 1px solid #000;*/
        /*background: #fff;*/
        /*width: 738px;*/
        /*height: 27px;*/
        /*margin: 0 0 20px;*/
        /*padding: 0;*/
        overflow: hidden;
    }

    .pictorial-wrapper {
        position: relative;
        /*left: 10px;*/
        /*top: 8px;*/
        /*width: 718px;*/
        overflow: hidden;
    }

    ul#ticker {
        white-space: nowrap;
        overflow: hidden;

        /*width: 1990px;*/

        /*width: 1730px;*/
        /*position: relative;*/
        /*left: 735px;*/
        /*font: bold 10px Verdana;*/
        list-style-type: none;
        margin: 0;
        /*padding: 0;*/
    }

    ul#ticker li {
        display: inline-block;
        vertical-align: top;
        margin: 20px 50px 20px 0;
        /*max-height: 280px;*/
        min-height: 280px;
        text-align: center;
        border-radius: 2px;
        max-width: 300px;
        min-width: 300px;

        /*float: left;*/
        /*margin: 0;*/
        padding: 0;
        background: #fff;
    }

    ul#ticker li .name {
        font-size: 16px;
        padding: 10px 0;
    }

    ul#ticker li .comment {
        font-size: 12px;
        padding: 0 10px 5px;
        font-weight: normal;
        white-space: normal;
    }

    ul#ticker li img {
        max-width: 100%;
        max-height: 200px;
        padding: 5px 10px;
    }
</style>
<script>
    String.prototype.trunc =
        function (n, useWordBoundary) {
            if (this.length <= n) {
                return this;
            }
            var subString = this.substr(0, n - 1);
            return (useWordBoundary
                    ? subString.substr(0, subString.lastIndexOf(' '))
                    : subString) + "&hellip";
        };
</script>
<div class="row pictorial-row">
    <div class="pictorial-container">

        <div class="pictorial-wrapper">

            <ul id="ticker" class="pictorial-ticker">
                {{--<marquee direction="left">--}}
                @foreach($pictorial as $row)
                    <?php
                    $subString = (strlen($row->comment) > 70) ? substr($row->comment,0,70).'...' : $row->comment;
                    ?>
                    <li>
                        <div class="name">{{$row->name}}</div>
                        <div class="comment">{{($row->comment == '')?'&nbsp;':$subString}}</div>
                        <img src="{{$row->image}}">
                    </li>
                @endforeach
                {{--</marquee>--}}
            </ul>

        </div>
    </div>
</div>
<script>
    $(function () {
        $('#ticker').marquee({
            //speed in milliseconds of the marquee
            duration: 10000,
            //pause on mouse hover
            pauseOnHover: true,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true
        });
    });
</script>