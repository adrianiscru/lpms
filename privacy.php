<?php # index.php
// This is the main page for the site.

include("includes/niche-configuration.php");

$page_title = 'Privacy Policy - ' . $niche . ' ';
$page_name = 'privacy.php';
$page_description = 'Privacy Policy - It Contains types of information that is collected and recorded by and how we use it.';

include("includes/header.html");

?>

    
    
<!-- PAGE CONTENT START -->
    
    <div class="row"> <!-- PAGE CONTENT --> 
        <div class="col-s-12 col-m-12 col-l-12">
            <div class="boxed-container cms-editable text-left set-1-b shadow-box">
                <h2>Lost Property Management System</h2><hr>
                <h2 class="mobile-small-text-1"><br>PRIVACY POLICY</h2>
                <p>At <span class=" "> <i><?php echo $niche;?> </i></span>, accessible from <u>https://localhost.0/OU/<?php echo strtolower ($niche);?></u>, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by  and how we use it.</p>
                <p>
                If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us through email <a href="mailto:<?php echo $email;?>?subject=<?php echo $niche;?>%20LPMS%20-%20privacy%20info%20requested.">HERE</a>.

                <h3>GDPR Information</h3>  
                <p> 
                What information we collect from users: cookie information about your visit and your email if you complete any optin forms on our site.
                <br>
                When we collect information from users: when you visit our website or sign up via an optin form.
                <br>
                Protection of that information: all information is securely stored and only accessible to relevant staff members in the execution of their tasks.
                <br>
                What we do with that information: we use cookies to enhance your visit, remember if you are logged in and to collect visit analytics.
                <br> 
                Data Protection Officer: Adrian Iscru
                </p>

                <h3>General Data Protection Regulation (GDPR)</h3>
                <p>
                We are a Data Controller of your information.
                <br>
                 legal basis for collecting and using the personal information described in this Privacy Policy depends on the Personal Information we collect and the specific context in which we collect the information:
                <br> 
                •	 needs to perform a contract with you<br>
                •	You have given  permission to do so<br>
                •	Processing your personal information is in  legitimate interests<br>
                •	 needs to comply with the law<br><br>
                 Will retain your personal information only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use your information to the extent necessary to comply with our legal obligations, resolve disputes, and enforce our policies.<br><br>
                If you are a resident of the European Economic Area (EEA), you have certain data protection rights. If you wish to be informed what Personal Information we hold about you and if you want it to be removed from our systems, please contact us.<br>
                In certain circumstances, you have the following data protection rights:<br>
                •	The right to access, update or to delete the information we have on you.<br>
                •	The right of rectification.<br>
                •	The right to object.<br>
                •	The right of restriction.<br>
                •	The right to data portability<br>
                •	The right to withdraw consent<br>
                </p>
                <h3>Log Files</h3>
                <p> follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analysing trends, administering the site, tracking users' movement on the website, and gathering demographic information.
                </p>
                <h3>Privacy Policies</h3>
                <p>You may consult this list to find the Privacy Policy for each of the advertising partners of .<br>
                Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on , which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.<br>
                Note that  has no access to or control over these cookies that are used by third-party advertisers.
                </p>
                <h3>Third Party Privacy Policies</h3>
                <p>Our Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You may find a complete list of these Privacy Policies and their links here: <u>Privacy Policy Links</u>.
                You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites. What Are Cookies?
                </p>

                <h3>Children's Information</h3>
                <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.<br>
                <?php echo $niche;?> does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records
                </p>

                <h3>Online Privacy Policy Only</h3>
                <p>This privacy policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in . This policy is not applicable to any information collected offline or via channels other than this website.</p>

                <h3>Consent</h3>
                <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>    
            </div>
        </div>
    </div>

<?php
include ('includes/footer.html');
?>
    


