## About CRM

CRM was built to manage my own client relations.  So many systems out there don't do what I want and/or are super expensive.  So I made this in a couple of days.  This was never intended to be used by anyone but myself.  However, it is open sourced as I felt people could benefit from it.  I will not be answering questions or supporting it due to this.  You are on your own.  Use at your own risk.

## Requirements

* CLI access (command-line-interface)
* Node
* Composer

## Install CRM

* Download the most recent files and upload them to your hosting root (not public_html).
* Change your website documents directory from public_html to public.  Alternatively you can use a symbolic link.  Laravel is set to use public not public_html.
* Login to CLI.
* Run ``npm install``
* Run ``composer update``
* Open your .env file and update your DB information and admin contact information (used for invoices).
* Run ``php artisan migrate``
* Run ``php artisan db:seed``
* You are all set!  Login with ``test@test.com`` : ``test1234``.  Make sure and change this using the easy to use GUI.

## Contributing

I will actually reject contributions or requests for the most part.  Again, this was built for MY needs not yours.  If you want to build some models/views/controllers and a migration to go with it then be my guest!  It will probably never be added to the core though.

## License

CRM is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
