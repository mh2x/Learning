=============================
EzShare App README
Created on 12-6-24
Author: Mohammad Elhaj
=============================

Goal: Allow people to share/view screen 
      Allow viewers to annotate / hilite / pinpoint stuff on the shared screen
	
 High-level design
 ------------------
  The app (class: AppManager) will maintain a list of participants that is divided into 2 lists
	1. Presenters : IPresentContent
	2. Viewers : IViewContent
   
	Each participant can be either a presenter or a viewer or both. Each can view content
	right now our content is simply a screen
   
	3. ScreenShare class implements IShareContent. 
	4. Screen can implement IShareableContent
	
   
!END