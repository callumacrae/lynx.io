<info>
title: Photoshop Guide (Part One)
author: anonymous
date: 1343923907
tags: photoshop, graphics, layers, tools
summary: This is the first in a series of articles that will be covering the various concepts you need to understand in order to use Photoshop, the tools that you have at your disposal and how to use them. To understand this post, you are expected to know or have previously read about image types: raster and vector.
</info>

*This is the first in a series of articles that will be covering the various concepts you need to understand in order to use Photoshop, the tools that you have at your disposal and how to use them. To understand this post, you are expected to know or have previously read about image types: raster and vector.*

## Photoshop Layers & Layer Types

![Layer Panel]({{ articleimages }}/layer_panel.png)
*The Photoshop Layer Panel*

Photoshop's "Layers" are the first and maybe most important concept that you need to understand. Just like a painting is the result of superposed layers of paint, a photoshop document is built up from various digital layers containing graphical data.
Pretty much everything in Photoshop is done on or through layers; whether it's doing 3D work, designing a website or digital painting, it all happens with layers.

Now, why are layers a good thing, and what can they do? The first feature I'm going to address is organization: layers allow you to organize your document into separate elements. You can name these, group them, remove them, and easily move them around. Using the analogy of the painting once again: imagine if you could simply move bits of your painting around, remove them, without affecting the rest of the painting — Photoshop enables you to do just that! You can organize them in the *Layer Panel* (drag and drop) and move elements around by using the *Move Tool* (see below).

Secondly, there's styling; Photoshop has two features called "layer masks" and "layer styles". Layer styles enable you to apply styling to a specific layer, be it drop shadows, a gradient overlay, etc. You can access layer styles by double clicking a layer in the *Layer Panel*. This, and layer masks are a bit more complicated, so we'll get into those in a future post.

Now of course, there are different types of layers, each with it's own purpose. The main types of layers you'll be using when designing interfaces, websites or similar things are the following (see the screenshot above for reference):

+ **Raster Layers:** Raster layers are the most basic layer type. If you aren't familiar with the concept of "raster" elements, it basically means that whatever on the layer is made up of pixels. All pictures are raster (photos, icons, etc). Their downside is that they do not scale, and are not flexible. *Raster layers are created using the "New Layer" button at the bottom of the Layer Panel.* All other layer types can be turned into a raster layer.
+ **Vector Shape Layers:** Vector layers are layers that contain vector data; shapes which are built up from points, and scale (similar to vectors in math). These are much more flexible as you can create custom shapes, place points, and edit these very easily. *Shape Layers are created using the shape tools and can be modified using the path and shape tools.*
+ **Smart Objects:** Smart objects are essentially smart raster layers. A very simple example of their use: you import a picture into your Photoshop document, and it appears as a smart object. Now, you resize it to make it smaller — to later realize that you need it back at it's original state. A smart object will scale down... but you can then scale it back up, and it'll look as if you hadn't scaled it down, and it won't have lost any quality from scaling it down first. *Smart objects are usually created by importing a picture into your document.*
+ **Type Layers:** Type layers are what you'd think of as "text" layers. Their advantage is that you can edit text that you placed, create paragraphs (bounds) and you have *a lot* of customizability when it comes to font details and spacing. *Type layers are created using the type tool.*

## Basic Photoshop Tools

So now that you know the different types of layers you can have, let's learn how to create them! As you'd expect, Photoshop has a large array of tools with various purposes. The main tools you'll be using (if you're doing interface design or something similar) are the following:

*Note that in this section, I'll be referring to the bar at the top of your screen with various buttons and settings as the "settings bar".*

![Tools Panel]({{ articleimages }}/tools_panel.png)
*The Photoshop Tools Panel*

### Shape Tools

The tool you'll be using for creating elements will usually be one of the shape tools. The shape tools create vector "shape layers" (see above) which will scale and are extremely flexible. The various shape tools you have at your disposal are the following;

+ **Rectangle Tool:** Creates a simple rectangle. This shape is the most basic and doesn't have any specific customization options.
+ **Rounded Rectangle Tool:** Draws a rounded rectangle. You can set the border radius for *all* the corners in the settings bar.
+ **Ellipse/ Circle Tool:** Draws an ellipse, and a circle if you press shift while using the tool. No specific options either.
+ **Polygon Tool:** Draws a polygon on the screen. You can set the number of sides that it should have in the settings bar.
+ **Line Tool:** Draws a simple line on the screen. You can set the width of the line in the settings bar ("weight").
+ **Custom Shape Tool:** Using the custom shape tool, you can draw more complex, pre-set shapes on the screen. You can choose which shape to draw in the settings bar. This is very useful for icons - once you've installed an icon set, you can simply draw them using this tool.

*I strongly suggest that you enable "Align Edges" for all the tools as it will stop Photoshop from making blurry edges (split pixels).*

### Path Tools

Paths are essentially the frame of shapes. When you have a shape layer, you in fact have the layer form of a path. This means that, when I previously said that shapes were very flexible, it means that you can edit the paths that constitute the shapes, using the path tools. Paths themselves, are built up from "points" that are linked between them. The path tools are the following:

+ **Pen Tools:** Both the normal pen tool and "Freeform" pen tool enable you to simply place points and create a new path.
+ **Convert Point Tool:** The convert point tool enables you to change the curve you can apply on points (instead of having straight lines connecting the points, you can also make them curved thanks to this tool).
+ **Add/ Remove Point Tools:** Quite simple, the add and remove point tools enable you to add or remove points onto/from *existant* paths.
+ **Path and Point Selection Tools:** The path selection tool enables you to select *a whole* path (all points that are linked between them). The point selection tool, on the other hand, enables you to select a single point on a path (more useful, if for example, you need to move the edge of a shape a few pixels).

### Type Tool

The type tool is, as for the type layer, the way to create text in Photoshop. Simply select the type tool, click on your document at the place you want to write, and that's it! You have a great amount of customization available in the settings bar, and you can also create paragraphs, which is to say an area with limits in which text can be written. Simply "select" the area that the paragraph should span, using the type tool. You will then have a "paragraph text" element, in which any text will stay and wrap to the bounds.

### Zoom Tool

The zoom tool is probably the tool you'll be using the most (no kidding). When you design, you'll often be zoomed right in to be able to get pixel perfect designs, and the zoom tool not only enables you to zoom in to specific areas, but also to go back to exactly the right size. When using the zoom tool, you can simply click on a certain region of your document, and Photoshop will zoom into it. Press Alt while using the zoom tool, and instead of zooming in, it will zoom out. You can also "select" an area you want on your screen. Finally, in the "settings bar" at the top of your screen, you should see a few buttons, such as "Actual Pixels" or "Fill Screen". Actual Pixels, for example, will zoom you back to the actual size of your document.

### Selection & Move Tools

Two of the most basic tools, but very useful nonetheless. First of all, the selection tool. The selection tool only works on raster layers, as they select an area of pixels. You can select between a rectangular selection or an ellipse, and add selections together or remove parts of selections using the Alt and Shift keys. The selection can then be copy/cut/pasted or have filters applied on it.

Then, we've got the Move tool. The move tool will work on any layer, as it's purpose is simply to move elements. You can move a selection, a shape, etc (you can also use the arrow keys to move the elements with more precision). Note that you should see some "resize" or "transform" tools appear when moving a tool; the move tool can also transform elements to a certain extent, such as resizing or rotating.

## Disclaimer

Firstly, this isn't a designing tutorial; as the title indicates, this guide aims to make you understand how Photoshop works while letting you experiment on your own. Secondly, *this guide is in no way complete*; I'm only covering the tools and concepts that come up the most and that you'll probably end up using the most. Photoshop has thousands of features for a variety of different tasks, and there is no way I could cover all of them.
