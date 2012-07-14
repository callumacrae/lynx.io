<info>
title: What are SSL certificates and where should I get one?
author: olie122333
date: 1324497180
tags: security, ssl, certificates
summary: SSL certificates also ensure the integrity of the server that the user is connecting to, as the certificate should be signed by a Certification Authority (CA) which the user’s browser trusts, acting as a guarantor of the server’s integrity.
</info>

## What is an SSL certificate?
**SSL** (Secure Socket Layer) is should be used by all e-commerce websites to protect their user’s personal data, such as credit card numbers and addresses. It works by encrypting the traffic between the user’s web browser and the server, making sure it can’t be intercepted.

SSL certificates also ensure the integrity of the server that the user is connecting to, as the certificate should be signed by a Certification Authority (CA) which the user’s browser trusts, acting as a guarantor of the server’s integrity.

A SSL certificate can be self-signed, but using a self-signed certificate is not recommended outside of your development environment or private, internal network. This is because if the browser doesn’t trust the Certification Authority, it will display a warning which will scare most visitors away, particularly if they aren’t technical.

There are two kinds of SSL certificates. Both provide security to the communications between the server and the user’s computer.

* Standard: This is used my most websites, particularly by individuals or small businesses. Most browsers display a small padlock symbol when connecting to a site using this type of certificate.
* Extended Validation (EV): This is used by a lot of large companies which handle a lot of personal data, such as e-commerce sites and online banking. In most modern browsers, the name of the business appears next to the URL. To obtain this type of certificate, the website must pass the extended validation checks which their Certification Authority imposes on this kind of certificate so users can be sure they are connecting to the real website.

## Where should I get an SSL certificate?

### Standard Certificate:

There are quite a lot of options for where to purchase your standard SSL certificate from. Bear in mind that a lot of them will be resellers of the better-known brands.

**[StartCom](http://www.startssl.com/?app=39)**

* Price: free / $59.90 (different levels of validation)
* Browser Recognition: FireFox, Chrome, Internet Explorer, Netscape, Opera, Safari, Android, iOS, and more
* Issued in: unknown
* Length of certificates: 1 year for free certificates, 2 years for Verified certificates ($59.90 p/y)

StartCom are known as a free certification authority, and they absolutely do work, even if their website is a pain to use. They are recognised in all of the main browsers, however it is recommended that free certificates are only used for development and testing environments, however the Verified certificates could be used in production if you wish.


**[GoDaddy](http://www.godaddy.com/Compare/gdcompare_ssl.aspx?isc=sslqguk10&amp;currencytype=USD)**

* Price: from $12.99 / £8.99 (special offer)
* Browser Recognition: 99%
* Issued in: minutes
* Length of certificates: 1-5 years
* Level of encryption: 256 bit

These certificates are from a well-known brand, and are quite cheap. You can purchase them for up to 5 years, and like most Certification Authorities, they claim to have 99% browser recognition.

**[RapidSSLOnline](https://www.rapidsslonline.com/)**

* Price: $9.50 (discounts for multi-year certificates)
* Browser Recognition: "over" 99%
* Site Seal: Yes
* Length of certificates: 1-5 years
* Level of encryption: 256 bit

These certificates are the cheapest of the ones that we have found. You can purchase them for up to 5 years, and if you purchase them for more than one year you get a discount. You can also put their "Site Seal" on your website.

### Extended Certificate:

There aren't as many options for extended SSL certificates, typically only the large Certification Authorities will offer these. They are also generally more expensive as the CA has to verify your identity to a higher level and so most sites cannot afford them and are forced to go with standard SSL certificates.

**[VeriSign](http://www.verisign.com/ssl/buy-ssl-certificates/extended-validation-ssl-certificates/index.html?sl=boxlink)**

* Price: $995 for 1 year, $1,790 for 2 years
* Level of encryption: 256 bit
* Trust Seal: yes
* Daily malware scanning: yes

**[StartCom](http://www.startssl.com/?app=39)**

* Price: $199.90 (introductory/special offer)
* Length of validity: 2 years

<span style="font-size: 10px;">Prices and features are a guide only as they are subject to change. We do not guarantee or endorse the products/companies listed here is any way. Not all Certification Authorities are listed here, only a selection.</span>