<info>
title: What are regular expressions?
author: samhaines
date: 1294207200
tags: php, regex
</info>

Regular expressions are a way for programs to search for a  particular pattern in a string. For example, they can be used to find strings starting with "www.", or to see if some user input is a valid email. Regular expressions are incredibly useful for validating user input and also for the mod\_rewrite function of the Apache server.

It is worth noting that the phrase "regular expression" is often shortened to "regex" or "regexp".

## Where are they used?

Regular expressions, and close variants of this, are used in  many different environments, including, but not limited to:

* Apache's mod_rewrite
* PHP's preg functions
* Microsoft Windows
* Java
* Oracle

As with most things, different environments are not always fully compatible with each other; however the basic syntax and ideas discussed within this article are common to most.

## Literal Characters

The simplest regexes are just matching for a simple text  pattern. Literal characters include every character except the special characters discussed below. They have no special meaning and simply match for  that particular letter.

For example the regex `cat` will match `cat` in `About cats and dogs`. Note that it only matches the first occurrence of the pattern by default but it can be set to  return all matches too.

## Special Characters

Special characters in regular expressions provide additional  functionality to create more complex regular expressions. The most common  special characters and their functions are described below:

<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <th width="20%">Character(s)</td>
    <th width="40%">Function</td>
    <th width="40%">Examples</td>
  </tr>
  <tr>
    <td><p>[ and ]</p></td>
    <td><p>Matches one out of several characters between the two square brackets.</p></td>
    <td><p>a[bc]d matches abd and acd</p></td>
  </tr>
  <tr>
    <td><p>\</p></td>
    <td><p>Allows the following special character to be used as a literal character.</p></td>
    <td><p>\[hi\] matches [hi] not h or i</p></td>
  </tr>
  <tr>
    <td><p>^</p></td>
    <td><p>Used within [ and ] to denote characters that are not allowed.<br>
            <em>or</em><br>
      Also denotes that the pattern should be matched at the start of the string.</p></td>
    <td><p>q[^u] matches qa but not q or qu<br>
            <em>or</em><br>
      ^cat matches cat but not scat</p></td>
  </tr>
  <tr>
    <td><p>$</p></td>
    <td><p>Denotes that the pattern should be matched at the end of the string.</p></td>
    <td><p>cat$ matches scat not cats</p></td>
  </tr>
  <tr>
    <td><p>.</p></td>
    <td><p>Matches any character, except new line characters.</p></td>
    <td><p>a.e matches ace and ade</p></td>
  </tr>
  <tr>
    <td><p>|</p></td>
    <td><p>Similar to [ and ] for single characters, but allows one of several    regexes to be matched. Often used with ( and ) to group possible regexes.</p></td>
    <td><p>cat|dog matches cat or dog not fish</p></td>
  </tr>
  <tr>
    <td><p>?</p></td>
    <td><p>Makes the preceding part of the regex optional.</p></td>
    <td><p>colou?r matches colour and color</p></td>
  </tr>
  <tr>
    <td><p>*</p></td>
    <td><p>Zero or more of the preceding part of the regex.</p></td>
    <td><p>be*n matches bn and been</p></td>
  </tr>
  <tr>
    <td><p>+</p></td>
    <td><p>One or more of the preceding part of the regex.</p></td>
    <td><p>be+n matches ben and been not bn</p></td>
  </tr>
  <tr>
    <td><p>( and )</p></td>
    <td><p>Groups part of a regex together, typically used with | and ? to give    choice of options or to make a section of the regex optional.</p></td>
    <td><p>(cat|dog)s matches cats and dogs<br>
            <em>or</em><br>
      lawn(mower)? Matches lawn and lawnmower</p></td>
  </tr>
  <tr>
    <td><p>{ and }</p></td>
    <td><p>Limits the repetition of a part of a regex. Can be used as a    replacement to * and +.<br>
      It has three uses:</p>
        <ul>
          <li>{n} repeats previous term n times</li>
          <li>{n,} repeats previous term n or more times</li>
          <li>{n,m} repeats previous term between n and m    inclusive</li>
        </ul></td>
    <td valign="top"><p>A{3} only matches AAA<br>
      A{3,} matches AAA and AAAA etc<br>
      A{3,5} only matches AAA, AAAA and AAAAA</p></td>
  </tr>
  <tr>
    <td><p>-</p></td>
    <td><p>Allows a range of values.</p></td>
    <td><p>a[b-y]z matches agz not aaz</p></td>
  </tr>
</table>

## Examples of Use

Probably the easiest way to describe the usage of regexes is to use some examples, in the context of a data validation script.

### Names

First we shall look at validating a name (either first  name or surname). The regex we will use is:

	^[A-Za-z-]{2,50}$

Let's dissect it down into several parts:

* `^` and `$` at the start and end of the regex  require the entirety of the string to match
* `[A-Za-z-]` matches all letters, both upper and  lowercase. The hyphen is required at the end for names like Anne-Marie
* `{2,50}` requires at least 2 and at most 50 characters. We're assuming people won't have names longer than 50 characters.

**Matches**: Sam, Anne-Marie<br>
**Does not match**: Sam54, BOB!

### Date
This checks that the date is in the correct format, but not necessarily  a valid date (eg 31 February 2010). This matches dates in the form DD/MM/YY, DD/MM/YYYY, DD-MM-YY, DD-MM-YYYY. It allows padding zeros be left out, for example 9/2/10.

	^(([1-9])|(1-2][0-9])|(3[0-1])) (/|-) ((0?[1-9])|(1[0-2])) (/|-)  (([0-9]{2})|((19|20) [0-9]{2}))$

Again, let's split it into several parts:

* `^` and `$` at the start and end of the regex require the entirety of the string to match
* `((0?[1-9])|(1-2][0-9])|(3[0-1]))` allows the day of the month to be anywhere between 1 and 31, with or without a zero for  padding.
* `(/|-)` between each group is to match the forward slashes or hyphen in the date.
* `((0?[1-9])|(1[0-2]))` matches the month number, between 1 and 12, with or without the zero for padding.
* `(([0-9]{2})|((19|20) [0-9]{2}))` matches a 2 or 4 digit year. If the year is 4 digit it requires it to be in the form 19xx or  20xx.

**Matches**: 03/03/2010, 3/3/10, 03-03-1994, 3-3-94<br>
Does not match**: 34/02/2010, 02/25/2010, 30.10.2010

Note: For use with American dates (MM/DD/YYYY general format), the following regex will work:

	^((0?[1-9])|(1[0-2]))(/|-)(([1-9])|(1-2][0-9])|(3[0-1]))(/|-)(([0-9]{2})|((19|20)[0-9]{2}))$

### Email

Regexes to validate email address can become quite complex,  therefore this particular example will not be explained in as much detail.

	^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$

**Matches**: e@abc.com, bob.jones@my.business.co.uk<br>
**Does not match**: .@eee.com, eee@e-.com, eee@eee.eeeeeeeeee

## Conclusion

Regexes can be used to great effect for selection of files, data validation and for rewriting URLS; pretty much any application of pattern matching. Regexes are well documented and many sites exist providing sample regexes for specific jobs.

Please note that often regexes are case sensitive and that different environments (PHP, Java etc.) may treat the same regex slightly different.
