<?php
class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome to ');
		$this->elements->checkalreadyuserloggedin();
		
        parent::initialize();
    }

    public function indexAction()
    {
        $encoded_saml_response = $this->request->getPost('SAMLResponse');
        $decoded_saml_response = base64_decode($encoded_saml_response);

        $dom = new DOMDocument();
        $dom->loadXML($decoded_saml_response);
        $doc = $dom->documentElement;
        $xpath = new DOMXpath($dom);
        $xpath->registerNamespace('samlp', 'urn:oasis:names:tc:SAML:2.0:protocol');
        $xpath->registerNamespace('saml', 'urn:oasis:names:tc:SAML:2.0:assertion');
        foreach ($xpath->query('/samlp:Response/saml:Assertion/saml:AttributeStatement/saml:Attribute', $doc) as $attr) 
        {
            //echo " # Attribute: " . $attr->getAttribute('Name') . "\n";
            if( $attr->getAttribute('Name') == 'email')
            {
                foreach ($xpath->query('saml:AttributeValue', $attr) as $value) 
                {
                    $emailid =  $value->textContent; 
                }
            }
        }
        $this->view->vidmemail = $emailid;
        //print_r($emailid);die;
    }

    
		
}
