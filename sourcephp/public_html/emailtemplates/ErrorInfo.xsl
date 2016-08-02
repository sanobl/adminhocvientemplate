<?xml version="1.0" encoding="UTF-8" ?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:msxml="urn:schemas-microsoft-com:xslt"
    xmlns:fo="http://www.w3.org/1999/XSL/Format"
    version="1.0">

  <xsl:output method="xml" media-type="text/html" omit-xml-declaration="yes"/>

  <xsl:template match="/">
    <xsl:variable name="EmailFormat" select="EmailFormat" />

    <TABLE style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;" cellSpacing="0" cellPadding="0" width="680" border="0">
      <TBODY>
        <TR>
          <TD background="https://@img_url@/theme/default/images/sendmail_top.jpg" height="28"></TD>
        </TR>
        <TR>
          <TD>
            <TABLE cellSpacing="0" cellPadding="0" width="100%" border="0">
              <TBODY>
                <TR>
                  <TD style="BACKGROUND-COLOR: #ef7510" width="5"></TD>
                  <TD>
                    <TABLE style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;" cellSpacing="0" cellPadding="0" width="100%" border="0">
                      <TBODY>
                        <TR>
                          <TD background="https://@img_url@/theme/default/images/title_bg.gif">
                            <IMG id="top" height="40" src="https://@img_url@/theme/default/images/title_thongbao.jpg" width="200" />
                            <TABLE>
                              <TR>
                                <TD>
                                  <TABLE cellSpacing=.;"0" cellPadding="0" width="94%" align="center" border="0">
                                    <TBODY>
                                      <TR>
                                        <TD style="FONT-SIZE: 100%; FONT-FAMILY: arial,sans-serif;">
                                          <P>Thân chào Anh/Chị,</P>
                                          <P>
                                          Hệ thống đang gặp vấn đề như sau:
                                          </P>
                                          <P>Tài khoản:</P>@Account@
                                          <P>Chức năng:</P>@Function@
                                          <P>Thông tin:</P>@ErrorInfo@
                                          
                                        </TD>
                                      </TR>
                                    </TBODY>
                                  </TABLE>
                                </TD>
                              </TR>
                           
                            </TABLE>
                          </TD>
                        </TR>
                      </TBODY>
                    </TABLE>
                  </TD>
                  <TD style="BACKGROUND-COLOR: #ef7510" width="5"></TD>
                </TR>
              </TBODY>
            </TABLE>
          </TD>
        </TR>
        <TR>
          <TD style="TEXT-ALIGN: center" vAlign="top" align="middle" background="https://@img_url@/theme/default/images/sendmail_bottom.jpg" height="28">VNG - Website Hỗ Trợ Khách Hàng Trực Tuyến: <a href = "https://hotro.zing.vn"><strong>www.hotro.zing.vn</strong></a></TD>
        </TR>
      </TBODY>
    </TABLE>

  </xsl:template>
</xsl:stylesheet>