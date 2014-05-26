Technooze_Tnewsletter
=====================

[![Flattr this git repo](http://api.flattr.com/button/flattr-badge-large.png)](https://flattr.com/submit/auto?user_id=dbashyal&url=https://github.com/dbashyal&title=Github Repos&language=&tags=github&category=software)

Technooze_Tnewsletter sends random coupon to newsletter subscribers.

admin &gt; Promotions &gt; Shopping Cart Price Rules.

Create new rule as.

*Rule Information*
- Rule name: Subscriber $10
- Status: Active
- Websites: Select websites
- Customer Groups: Select all other than NOT LOOGED IN
- Coupon: Specific Coupon
- Coupon code: Leave empty
- Select *\[\] User auto generation*
- Uses per Coupon: 1
- Uses per Customer: 1
- Public In RSS Feed: NO

*Conditions* (*leave empty*)

*Actions*
- Apply: Fixed amount discount
- Discount amount: 10

SAVE!!!

Go to: Admin &gt; System &gt; Transactional Emails &gt; Add new template as
- Template: Newsletter subscriber coupon
- Locale: Your website locale
- click on 'Load Template' button
- set Temaplate name and subject
- update template content to your liking

SAVE TEMPLATE!!!


Go to:
Admin &gt; System &gt; Configuration &gt; Newsletter &gt; TNewsletter (coupons)
- Enable Module: YES
- Send Coupon: YES
- Shopping Cart Price Rule: Subscriber $10
- Length: 12
- Format: Alphanumeric
- Prefix: NEWS- (empty or as you like)
- Suffix: -LETTER (empty or as you like)
- Dash: 3
- Email Template: New email template you created at transactional emails

SAVE CONFIG!!!

Sample coupon generated with above config: *NEWS-9RL-1VM-QUG-NTQ-LETTER*
