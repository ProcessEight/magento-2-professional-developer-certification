# Magento 2 Professional Developer Certification

**Note that the Magento version included in this project (2.2.5) is broken and cannot be upgraded to 2.3.1. Therefore, use a separate installation of Magento 2.3.1 instead.**

## Introduction

The Magento 2 Certified Professional Developer exam is designed to validate the skills and knowledge needed to customize Magento 2 in the areas of: 
* UI modifications, 
* database changes, 
* admin modifications, 
* checkout process customizations, 
* order management integrations and customizations, 
* catalog structure and functionality changes. 

This exam is for a Magento 2 developer who has a deep understanding of Magento 2 development concepts and experience (recommend 1.5 years) in implementing and customizing Magento 2.

## Rubric

* 60 Multiple Choice items
* 90 minutes to complete the exam
* A score of 64% or higher is needed to pass the Magento 2 Certified Professional Developer exam
* This exam consists primarily of scenario-based questions in a multiple-choice format.
* Based on Magento Open Source (2.3) and Magento Commerce (2.3), but applicable to those using any version of Magento 2.

## Exam topics

Exam topics and the percentage covered in the exam:

* Magento Architecture & Customization Techniques 18%
* Request Flow Processing 12%
* Customizing the Magento UI 10%
* Working with Databases in Magento 7%
* Using the Entity-Attribute-Value (EAV) Model 8%
* Developing with Adminhtml 10%
* Customizing the Catalog 12%
* Customizing the Checkout Process 13%
* Sales Operations 5%
* Customer Management 5%

## Study plan

### Do the Swift Otter mock exam

* Noting which areas you are weakest on
* Go through each question which you got wrong and research why. Grok the right answer.
* Repeat the Swift Otter exam every week, to gauge your progress (but if you notice yourself memorising the right answers, do it more infrequently).

### Work through the Swift Otter Exam Preparation ebook

* Work through the guide, prioritising areas you are weakest on (from the mock exam) and also areas which have the highest proportion of questions (according to the official Magento Study Guide).
* Review Swift Otter guide for each of these sections
* Review notes for matching section in https://github.com/magento-notes/magento2-exam-notes
* Consult the DevDocs before and during EVERY topic below
* Consult the core for examples of each topic below
* Making your best effort to understand the what/where/when/why/how of the core codebase to understand the effects that your code will have, e.g.
    * What options are there in the config which can affect the logic?
    * How can you customise the operation of the logic?
* Document everything in your own DevDocs - build up your own archive of documentation. Perhaps we could even sell it/use it as a base for a book at some point.
* Produce example module demonstrating how to achieve points in section
  * Include examples of how to achieve said functionality:
    * Programmatically; Either via a command or using an install script
    * Manually; via the admin
* Add points for further research to [Magento Research Topics](https://github.com/ProcessEight/hydrogen/projects/8) project

### Then

* Work through lower-priority areas of study guide using framework above
* Work through tasks in [Certification](https://github.com/ProcessEight/hydrogen/projects/3) project

## Topics

Work through Swift Otter (and other learning resources) in this order:

| Topic  | Proportion of Questions  | Swift Otter Mock Exam Score  | Swift Otter Mock Exam Score (2019-04-27) | 
|---|---|---|---|
| Overall | 100% | ?? | 80% |
| Request Flow Processing | 12% | 50% | 40% |
| Developing with Adminhtml | 10% | 50%  | 25% |
| Working with Databases in Magento | 7% | 50%  | 27.78%
| Customer Management | 5% | 50%  | 41.67% |
| Using the Entity-Attribute-Value (EAV) Model | 8% | 66.67%  | 55.56% | 
| Customizing the Catalog | 12% | 75%  | 41.67% |
| Magento Architecture and Customization Techniques | 18% | 87.5% | 43.96% | 
| Customizing the Magento UI | 10% | 87.5%  | 33.33% |
| Customizing the Checkout Process | 13% | 100%  | 25% |
| Sales Operations | 5% | 100%  | 50% |

## Resources

### Documents

* (PDF) MAGENTO 2 CERTIFIED PROFESSIONAL DEVELOPER EXAM PREPARATION EBOOK: Swift, Joseph. Swift Otter.
    * Location: 
        * UKFast cloud-shaped USB key drive: `/HAR/Magento/2/Training`,
        * zone8-aurora: `/data/hydrogen/magento-resources/magento-2/documentation/certification/swift-otter/Magento 2 Certified Professional Developer Study Guide` 
 
* (PDF) MagentoU - Magento 2 Certified Associate Developer Exam Study Guide: Magento.
    * Locations: 
        * UKFast cloud-shaped USB key drive: `/HAR/Magento/2/Training`, 
        * zone8-aurora: `/data/hydrogen/magento-resources/magento-2/documentation/certification/magento-u/Study guides`

### Magento.com

* Magento U Courses (past and present)
* Magento U Free videos
* Continuous Learning as a Developer https://community.magento.com/t5/Magento-DevBlog/Continuous-Learning-as-a-Developer/ba-p/94044
* DevDocs: http://devdocs.magento.com/
* DevBlog: http://community.magento.com/devblog/

### Gists

Becoming Certified by Vinai Kopp

https://gist.github.com/ProcessEight/91bb00ac508ffe978bc0f309fae3f51f#becoming-certified-by-vinai-kopp

Fundamentals of Magento 2 Development (v2.1): Unit One: Magento 2 Platform and architecture (With notes explaining what has changed in Magento 2.2.0)

https://gist.github.com/ProcessEight/f51886fe5aa2ff7761c697e5b401cf72

Fundamentals of Magento 2 Development (v2.1): Unit Two: Request Flow (With notes explaining what has changed in Magento 2.2.0)

https://gist.github.com/ProcessEight/bc4d0fe36ad28f60ca3a9126f5ab5d53

Fundamentals of Magento 2 Development (v2.1): Unit Three: Rendering (With notes explaining what has changed in Magento 2.2.0)

https://gist.github.com/ProcessEight/b2357ea923ccd85369c1020c901081ed

Fundamentals of Magento 2 Development (v2.1): End of Unit Quizzes (with answers)

https://gist.github.com/ProcessEight/5e57863d6b8b4bdd9671a19b95266e17

Anatomy of Magento 2: Service Contracts

https://gist.github.com/ProcessEight/a14e6512616353917bfe9e1fbfc90802

Anatomy of Magento 2: Extension Attributes

https://gist.github.com/ProcessEight/da06d767a400a62d76faaa791ed3d0ca

Anatomy of Magento 2: API

https://gist.github.com/ProcessEight/74cd880994cff8fe2604e79da44b52f3

Anatomy of Magento 2: Price Indexing

https://gist.github.com/ProcessEight/e161d4dc7a744d2727bbf4360ecda615

Anatomy of Magento 2: Price Generation

https://gist.github.com/ProcessEight/640aac60b9711b8a6a1e68049ee00fdf

### Repositories

Magento 2 study guides in Markdown format

https://github.com/df2k2/m2cert

Magento 2 Certified Professional Developer notes

https://github.com/magento-notes/magento2-exam-notes

### Agency blogs

* Swift Otter
    * Course notes eBook: https://swiftotter.com/technical/certifications/magento-2-certified-developer-study-guide
    * Practice exam
* integer_net
    * Magento 2 Certified Professional Developer: About the Exam: https://www.integer-net.com/magento-2-certified-professional-developer-about-the-exam/
* netz98: 
    * „Magento 2 Certified Professional Developer“: Profi-Tipps zur Zertifizierung (de_DE) https://www.netz98.de/blog/magento-howto/profi-tipps-zur-zertifizierung-magento-2-certified-professional-developer/
    * Infos zur Zertifizierung zum Magento 2 Certified Professional Developer (de_DE) https://www.netz98.de/magento/magento-2-certified-professional-developer/   
* BelVG:
    * Links to detailed articles expanding on points from the official study guide: https://belvg.com/blog/plus-two-magento-2-certified-professional-developer-at-belvg.html#step_7
* Mage Module:
    * A suprisingly insightful article discussing the methodology of preparing for the exam (especially the 'Specific things I did to prepare' section): https://www.magemodule.com/all-things-magento/professional-life/magento-2-certified-professional-developer-plus/

### Videos

* Mage Talk: https://www.youtube.com/watch?v=1WHxZH60AvU
* Nomad Mage
* Mage2.tv
* Mage2Katas

### Other Resource Lists

https://github.com/aleron75/mageres

https://github.com/DavidLambauer/awesome-magento2