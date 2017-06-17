<!DOCTYPE style-sheet PUBLIC "-//James Clark//DTD DSSSL Style Sheet//EN" [
<!ENTITY % html "IGNORE">
<![%html;[
<!ENTITY % print "IGNORE">
<!ENTITY docbook.dsl PUBLIC "-//Norman Walsh//DOCUMENT DocBook HTML Stylesheet//EN" CDATA dsssl>
]]>
<!ENTITY % print "INCLUDE">
<![%print;[
<!ENTITY docbook.dsl PUBLIC "-//Norman Walsh//DOCUMENT DocBook Print Stylesheet//EN" CDATA dsssl>
]]>
]>

<style-sheet>

<style-specification id="print" use="docbook">
<style-specification-body> 

;; ==============================
;; customize the print stylesheet
;; ==============================

;;TOC/LOT Apparatus
    (define %generate-set-toc% #t)
    (define %generate-book-toc% #t)
    (define %generate-book-lot-list% #t)
    (define %generate-part-toc% #t)
    (define %generate-part-toc-on-titlepage% #t)
    (define %generate-reference-toc% #t)
    (define %generate-reference-toc-on-titlepage% #t)
    (define %generate-article-toc% #t)
    (define %generate-article-toc-on-titlepage% #t)
;;Titlepages
    (define %generate-set-titlepage% #t)
    (define %generate-book-titlepage% #t)
    (define %generate-part-titlepage% #t)
    (define %generate-partintro-on-titlepage% #t)
    (define %generate-reference-titlepage% #t)
    (define %generate-chapter-titlepage% #t)
    (define %generate-article-titlepage% #t)
    (define %generate-article-titlepage-on-separate-page% #f)
;;RefEntries and FuncSynopses
    (define %funcsynopsis-decoration% #t)
;;Fonts
    (define %title-font-family% "Helvetica")
    (define %body-font-family% "Palatino")
    (define %mono-font-family% "Courier New")
    (define %visual-acuity% "normal")
    (define %hsize-bump-factor% 1.0)
    (define %smaller-size-factor% 0.6)
    (define %verbatim-size-factor% #f)
    (define %bf-size% 10pt)
;;Backends
    (define tex-backend #t)
    (define %default-backend% "tex")
    (define %print-backend% "tex")
;;Verbatim Environments
    (define %verbatim-default-width% 0pt)
    (define %indent-address-lines% #f)
;;Labelling
    (define %section-autolabel% #t)
    (define %chapter-autolabel% #t)
    (define %label-preface-sections% #t)
;;Running Heads
    (define %chap-app-running-heads% #f)
;;Paper/Page Characteristics
    (define %paper-type% "A4")
    (define %two-side% #f)
    (define %page-n-columns% 1)
;;    (define %left-right-margin% 6pi)
    (define %left-margin% 4pi)
    (define %right-margin% 4pi)
    (define %top-margin% 4pi)
    (define %bottom-margin% 4pi)
    (define %page-number-restart% #f)
;;Admonitions
    (define %admon-graphics-path% "./")
    (define %admon-graphics% #f)
;;Quadding
    (define %default-quadding% 'justify)
    (define %section-title-quadding% 'start)
    (define %section-subtitle-quadding% 'start)
    (define %article-title-quadding% 'center)
    (define %article-subtitle-quadding% 'center)
    (define %division-title-quadding% 'end)
    (define %division-subtitle-quadding% 'end)
    (define %component-title-quadding% 'start)
    (define %component-subtitle-quadding% 'start)
;;Footnotes
    (define bop-footnotes #f)
    (define %footnote-ulinks% #f)
;;Graphics
    (define %graphic-extensions% '("eps" "epsf" "gif" "tif" "tiff" "jpg" "jpeg" "png"))
    (define %graphic-default-extension% "eps")
    (define image-library #t)
;;Indents
    (define %para-indent% 0pt)
    (define %para-indent-firstpara% 0pt)
    (define %block-start-indent% 10pt)
;;Vertical Spacing
;    (define %line-spacing-factor% 1.2)
    (define %head-before-factor% 0)
    (define %head-after-factor% 0)
;;    (define %body-start-indent% 20pt)
;;    (define %para-sep% 11pt) 
;    (define %block-sep% 12pt) 
;;Object Rules
    (define %figure-rules% #t)
;;Miscellaneous
    (define formal-object-float #t)
    (define %hyphenation% #t)


    (declare-characteristic preserve-sdata?  "UNREGISTERED::James Clark//Characteristic::preserve-sdata?" #f)
    (define %factor% 0.6)
    (define %show-ulinks$ #f)
    (define (toc-depth nd) 2)

    (define para-style
      (style
        font-size: %bf-size%
        font-weight: 'medium
        font-posture: 'upright
        font-family-name: %body-font-family%
        line-spacing: (* %bf-size% %line-spacing-factor%)))

    (define (chunk-skip-first-element-list)
       (list (normalize "sect1")
       (normalize "section")))

    (element (formalpara title)
;;      (make sequence
;;        font-weight: 'bold
;;        ($runinhead$))
      ($lowtitle$ 5))

(element beginpage
  (make display-group
      break-before: 'page
      (make sequence
        (process-children))))

   
<!--
(define ($section$)
  (if (have-ancestor? '("ARTICLE" "SECT1") (current-node))
      (make simple-page-sequence
	page-n-columns: %page-n-columns%
	page-number-restart?: (or %page-number-restart% 
				  (book-start?) 
				  (first-chapter?))
	page-number-format: ($page-number-format$)
	use: default-text-style
	left-header:   ($left-header$)
	center-header: ($center-header$)
	right-header:  ($right-header$)
	left-footer:   ($left-footer$)
	center-footer: ($center-footer$)
	right-footer:  ($right-footer$)
	start-indent: %body-start-indent%
	input-whitespace-treatment: 'collapse
	quadding: %default-quadding%
	(make sequence
	  ($section-title$)
	  (process-children)))
      (make display-group
	space-before: %block-sep%
	space-after: %block-sep%
	start-indent: %body-start-indent%
        break-before: 'page
	(make sequence
	  ($section-title$)
	  (process-children)))))
-->
</style-specification-body>
</style-specification>

<!--
;; ===================================================
;; customize the html stylesheet; borrowed from Cygnus
;; at http://sourceware.cygnus.com/ (cygnus-both.dsl)
;; ===================================================
-->

<style-specification id="html" use="docbook">
<style-specification-body> 

;;;TOC/LOT Apparatus
    (define %generate-set-toc% #t)
    (define %generate-book-toc% #t)
    (define ($generate-book-lot-list$) #t)
    (define %generate-part-toc% #t)
    (define %generate-part-toc-on-titlepage% #t)
    (define ($generate-chapter-toc$) #f) 
    (define %generate-article-toc% #t)
    (define %generate-reference-toc% #t)
    (define %generate-reference-toc-on-titlepage% #t)
;;;Titlepages
    (define %generate-set-titlepage% #t)
    (define %generate-book-titlepage% #t)
    (define %generate-part-titlepage% #t)
    (define %generate-partintro-on-titlepage% #t)
    (define %generate-reference-titlepage% #t)
    (define %generate-article-titlepage% #t)
    (define %generate-legalnotice-link% #t)
;;;Admonitions
    (define %admon-graphics-path% "./stylesheet-images/")
    (define %admon-graphics% #f)
;;;Navigation
    (define %header-navigation% #t)
    (define %footer-navigation% #t)
    (define %gentext-nav-tblwidth% "100%")
    (define %gentext-nav-use-ff% #f)
    (define %gentext-nav-use-tables% #t)
;;;Verbatim Environments
    (define %shade-verbatim% #t)
;;;Labelling
    (define %section-autolabel% #t)
    (define %chapter-autolabel% #t)
    (define %label-preface-sections% #t)
;;;Graphics
    (define %graphic-default-extension% "gif")
    (define %graphic-extensions% '("gif" "png" "jpg" "jpeg" "tif" "tiff"))
    (define image-library #t)
;;;HTML Parameters and Chunking
;    (define %body-attr% (list (list "BGCOLOR" "#C0C0C0")))
    (define %html-ext% ".html")
    (define %root-filename% "index")
    (define html-index #t)
    (define html-index-filename "HTML.index")
    (define html-manifest #t)
;    (define nochunks #t)
    (define rootchunk #t)
    (define %stylesheet% "/curriculum-vitae.css")
    (define %stylesheet-type% "text/css")
    (define %use-id-as-filename% #t)
;;;RefEntries and FuncSynopses
    (define %funcsynopsis-decoration% #t)
;;;HTML Content and CSS
    (define %html40% #t)
    (define %css-decoration% #f)
;;;Object Rules
    (define %figure-rules% #f)
;;;Miscellaneous
    (define %default-simplesect-level% 4)

    (declare-characteristic preserve-sdata? "UNREGISTERED::James Clark//Characteristic::preserve-sdata?" #f)
    (define %factor% 0.6)
    (define (toc-depth nd) 2)
    (define (chunk-element-list)
      (list (normalize "preface")
            (normalize "chapter")
            (normalize "appendix") 
            (normalize "article")
            (normalize "glossary")
            (normalize "bibliography")
            (normalize "index")
            (normalize "titlepage")
            (normalize "setindex")
            (normalize "reference")
            (normalize "refentry")
            (normalize "part")
            (normalize "toc") 
            (normalize "section")
            (normalize "book")
            ))

     (define (chunk-skip-first-element-list) '())
     (define (list-element-list) '())

	(define %html-header-tags%
 		'(
			("META" ("NAME" "name") ("CONTENT" "Dag Wieers"))
			("META" ("NAME" "email") ("CONTENT" "dag@wieers.com"))
			("META" ("NAME" "description") ("CONTENT" "Curriculum Vitae of Dag Wieers"))
			("META" ("NAME" "keywords") ("CONTENT" "Curriculum Vitae, CV, Resume, Biography, Dag Wieërs, Dag Wieers, Linux, Belgie, Belgium, België, Who Is"))
	))



</style-specification-body>
</style-specification>

<external-specification id="docbook" document="docbook.dsl">

</style-sheet>
