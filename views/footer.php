<div class="footer">
    <div class="row">
        <div class="column">
            <div class="four columns">
                <h6><i class="fa fa-fw fa-info-circle" aria-hidden="true"></i> เกี่ยวกับเรา</h6>
                <p>เว็บไซต์นี้จัดทำเพื่อการศึกษาวิชา 801301 การพัฒนาโปรแกรมคอมพิวเตอร์ประยุกต์สำหรับเทคโนโลยีสารสนเทศ 1 มิได้มีเจตนาละเมิดลิขสิทธิ์ และไม่มีการซื้อขายแลกเปลี่ยนเงินตราจริงในเว็บไซต์นี้</p>
                <p>This website is for educational purpose. There is no intention of copyright infringement and no actual trade activities.</p>
                <p>ขอบคุณเนื้อหาจากเว็บไซต์ www.uniqlo.com/th/</p>
            </div>
            <div class="four columns">
                <ul>
                    <h6><i class="fa fa-fw fa-question-circle" aria-hidden="true"></i> บริการลูกค้า</h6>
                    <?php
                    $sql = "SELECT * FROM `page_content`;";
                    $query = mysqli_query($DBConnect, $sql, MYSQLI_STORE_RESULT) or die ("Query Error");
                    $num_row = mysqli_num_rows($query);
                    while ($row = mysqli_fetch_assoc($query)) {?>
                      <li><a href="/?page=<?php echo $row['cont_url'];?>"><?php echo $row['cont_title'];?></a></li>
                    <?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                         }  $query->close();?>
                    <li><a href="#">นโยบายความเป็นส่วนตัว</a></li>
                    <li><a href="#">ข้อตกลงและเงื่อนไข</a></li>
                    <li><a href="#">Site Map</a></li>
                </ul>
            </div>
            <div class="four columns no-margin">
                <ul>
                    <h6>เครือข่ายสังคม</h6>
                    <p><a href="https://www.facebook.com/tta.nattawut" target="_blank" ><span class="fa-stack fa-lg">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-facebook fa-stack-1x"></i>
                  </span></a>
                        
                        <span class="fa-stack fa-lg">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-twitter fa-stack-1x"></i>
                  </span>
                        <span class="fa-stack fa-lg">
                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                    <i class="fa fa-google-plus fa-stack-1x"></i>
                  </span>
                    </p>
                </ul>
                <ul>
                    <h6>ปลอดภัยด้วยการชำระเงินออนไลน์</h6>
                    <p>
                        <i class="fa fa-fw fa-3x fa-google-wallet" aria-hidden="true"></i>
                        <i class="fa fa-fw fa-3x fa-cc-paypal" aria-hidden="true"></i>
                        <i class="fa fa-fw fa-3x fa-cc-visa" aria-hidden="true"></i>
                        <i class="fa fa-fw fa-3x fa-cc-amex" aria-hidden="true"></i>
                        <i class="fa fa-fw fa-3x fa-cc-discover" aria-hidden="true"></i>
                        <i class="fa fa-fw fa-3x fa-cc-mastercard" aria-hidden="true"></i>
                    </p>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="u-full-width">
            <p class="copyright">&copy; 2016 Copyright by ณัฐวุฒิ กิติวรรณ</p>
        </div>
    </div>
</div>
</div>

<script type="text/javascript" src="lib/js/validation.min.js" async></script>
<script type="text/javascript" src="lib/js/tools.min.js" async></script>
<script src="https://use.fontawesome.com/7bd307103a.js" async></script>
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-88376110-1', 'auto');
    ga('send', 'pageview');
</script>
</body>

</html>
