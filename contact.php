<section class="contactUs">
    <div class="container">
            <div class="row">
                <div class="section-title padd-15">
                    <h2>Get in touch</h2>
                </div>
            </div>
    
        <div class="box">
            <!--Form-->
            <form class="contact form" action="javascript:sendmail()" method="POST">
                <!-- "écrit cettte code dans le tag form :action="https://formsubmit.co/el/zoruca" id="target" method="POST"-->
                <h3>Send a Message</h3>
                <div class="formBox">
                    <div class="row50">
                        <div class="inputBox">
                            <Label class="title_span">First Name</Label>                            
                            <input id="first_name" type="text" name="first_name" placeholder="Example : Imade" required>                
                        </div>
                        <div class="inputBox">
                            <Label class="title_span">Last Name</Label> 
                            <input id="last_name" type="text" name="last_name" placeholder="Example : ELMACHRAA" required>                
                        </div>
                    </div>
                    <div class="row50">
                        <div class="inputBox">
                            <label class="title_span">Email</label>
                            <input id="email" type="text" name="email" placeholder="Example : Imade@gmail.com" required>                
                        </div>
                        <div class="inputBox">
                            <label class="title_span">Mobile</label>
                            <input id="mobile" type="text" name="mobile" placeholder="Example : +212 700 000 000" required>                
                        </div>
                    </div>
                    <div class="row100">
                        <div class="inputBox">
                            <label class="title_span">Message</label>
                            <textarea id="message" placeholder="write your message here..." required></textarea>
                        </div>
                    </div>
                    <div class="row100">
                        <div class="inputBox">
                            <input type="submit" value="Send">                
                        </div>
                    </div>
                </div>
                </form>
            <!--info Box-->
            <div class="contact info">
                <h3>Contact Info</h3>
                <div class="infoBox">
                    <div>
                        <span class="info_icon"><i class="fa fa-map-marker"></i></span>
                        <p>62 Rue El Kadi Bekkar<br> Casablanca, MAROC</p>
                    </div>
                    <div>
                        <span class="info_icon"><i class="fa fa-envelope"></i></span>
                        <a href="mailto:loremipsum@gmail.com">loremipsum@gmail.com</a>
                    </div>
                    <div>
                        <span class="info_icon"><i class="fa fa-phone"></i></span>
                        <a href="tel:+212 500 000 000">+212 500 000 000</a>
                    </div>
                    <!--Social Media Links-->
                    <ul class="sci">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="https://www.linkedin.com/company/dumtac/about/"><i class="fa fa-linkedin"></i></a></li>                        
                        <li><a href="https://www.instagram.com/dumtac/"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>                
            </div>
            <!--Map-->
            <div class="contact map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3324.3224914104085!2d-7.646934785537208!3d33.57097515038674!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7d2d01c0b5e8d%3A0xe4b02bc46fd58116!2s62%20Rue%20El%20Kadi%20Bekkar%2C%20Casablanca!5e0!3m2!1sfr!2sma!4v1649935265442!5m2!1sfr!2sma"style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>      
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://smtpjs.com/v3/smtp.js"></script>
            
<script>
   var FormBox = $("#formBox").val();
        //function to send the message when click on button send
        function sendmail(){ 

            var First_name = $("#first_name").val();
            var Last_name = $("#last_name").val();
            var Mail = $("#email").val();
            var Mobile = $("#mobile").val();
            var Message = $("#message").val();
            
            var Body = 'first_name :'+First_name+'<br>last_name :'+Last_name+'<br>email :'+Mail+'<br>mobile :'+Mobile+'<br>message :'+Message;
            
            Email.send({
                Host : "smtp.yourisp.com",
                Username : "imadelmachraa0@gmail.com",
                Password : "password",
                To : "imadelmachraa0@gmail.com",
                From : Mail.value,
                Subject : 'New Mail On Contact Form From :'+First_name+" "+Last_name, 
                Body : Body
            }).then( 
                message => alert(Message)
            );    
        }        
       
        
    // add the event Listener submit :

 /*   FormBox.addEventListener('submit', sendMsg);
     
function submit() {
        $("#target").unbind('submit').submit()
    }

    $(document).ready(function () {
        $('#target').on('submit', function (e) {
            e.preventDefault();
            $('#captcha').show();
        });
    });*/

</script>