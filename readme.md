# countTrackula 2.0
With this snippet you will have the ability to display the number of downloads for a local file or the number of clicks on a remote file. It'll also create a hashed link of the local or remote file for security purposes hiding the file path of a locally hosted file.

## System Settings
| Name | Description |
|--|--|
| `algo` | The desired algorithm to use when creating a checksum of the download file. Refer to the PHP Documentation for a list of supported algorithms to choose from. Default: `SHA1` |
| `salt` | Define a secret passphrase to be used with generating the checksum. Default: `countTrackula's best friend is decrypt-keeper` |
| `core_path` | Just the path to the component files for use with the snippet. Best just to leave this untouched. |


## Properties
| Property | Type | Req/Opt | Description |
|--|--|--|--|
| `&path` | String | Required | Path to the download file from webroot.
| `&file` | String | Required | The filename of the download without slashes. |
| `&name` | String | Required | The name of your download file for display purposes. |
| `&term` | String | Optional | The word shown next to download count. (*i.e.* 18 hits) |
| `&hits` | Boolean | Optional | If true, only shows the download count of `&file`. |
| `&tpl` | String | Optional | The chunk used for displaying the download link to the client. |


## Example

#### &mdash;Locally Hosted Files
Define a download with a property **path** of `downloads/` and a property **file** of `MyPackage.zip` with the property **name** of `My Package`

##### **SOURCE**:

    [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &name=`My Package`]]

##### **OUTPUT**:
My Package (18 downloads)

    <a href="http://example.com/?download=SALTEDHASHCHECKSUM">My Package</a> (18 downloads)
To only show the download count of *My Package*  but use the term *hits* instead of *downloads* use the following:

    [[!countTrackula? &path=`downloads/` &file='MyPackage.zip' &hits=`true` &term=`hits`]]
##### OUTPUT:
18 hits


#### &mdash;Remotely Hosted Files
To define a remote file for download with the property **term** of *clicks* set the **file** property as the link to the file like below. *Note:* This feature has barely been tested so please report any erroneous findings you may run into on my [GitHub project page](https://github.com/daemondevin/countTrackula).
##### SOURCE:

    [[!countTrackula? &file=`http://example.com/files/countTrackula-2.0-pl.transport.zip` &name=`countTrackula` &term=`clicks`]]
##### OUTPUT:
countTrackula (18 clicks)

    <a href="http://example.com/?download=SALTEDHASHCHECKSUM&link=true">countTrackula</a> (18 clicks)
